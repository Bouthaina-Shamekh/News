(function () {
    'use strict';

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    var mobileView = window.matchMedia('(max-width: 768px)');

    function cloneItems(items) {
        return items.map(function (item) {
            var clone = item.cloneNode(true);
            clone.setAttribute('data-ticker-clone', 'true');
            clone.setAttribute('aria-hidden', 'true');

            clone.querySelectorAll('a, button, input, select, textarea').forEach(function (focusable) {
                focusable.setAttribute('tabindex', '-1');
            });

            return clone;
        });
    }

    function setupTicker(root) {
        var track = root.querySelector('[data-news-ticker-track]');

        if (!track || reduceMotion.matches) {
            return;
        }

        var originalItems = Array.prototype.slice.call(track.children);

        if (originalItems.length < 2) {
            return;
        }

        var direction = root.getAttribute('data-ticker-direction') === 'right' ? 'right' : 'left';
        var speed = mobileView.matches ? 42 : 58;
        var segmentWidth = 0;
        var offset = 0;
        var lastTime = 0;
        var paused = false;
        var frameId = null;
        var resizeFrame = null;

        function removeClones() {
            track.querySelectorAll('[data-ticker-clone="true"]').forEach(function (clone) {
                clone.remove();
            });
        }

        function fillTrack() {
            var firstOriginal = originalItems[0];
            var firstClone = null;
            var minimumWidth = root.clientWidth;

            removeClones();
            track.style.transform = 'translate3d(0, 0, 0)';

            cloneItems(originalItems).forEach(function (clone, index) {
                if (index === 0) {
                    firstClone = clone;
                }

                track.appendChild(clone);
            });

            segmentWidth = Math.abs(firstClone.getBoundingClientRect().left - firstOriginal.getBoundingClientRect().left);

            if (!segmentWidth) {
                return;
            }

            while (track.scrollWidth < segmentWidth + minimumWidth + 1) {
                cloneItems(originalItems).forEach(function (clone) {
                    track.appendChild(clone);
                });
            }

            offset = direction === 'right' ? -segmentWidth : 0;
            track.style.transform = 'translate3d(' + offset + 'px, 0, 0)';
        }

        function tick(time) {
            if (!lastTime) {
                lastTime = time;
            }

            var delta = (time - lastTime) / 1000;
            lastTime = time;

            if (!paused && segmentWidth) {
                if (direction === 'right') {
                    offset += speed * delta;

                    if (offset >= 0) {
                        offset = -segmentWidth + (offset % segmentWidth);
                    }
                } else {
                    offset -= speed * delta;

                    if (offset <= -segmentWidth) {
                        offset = -(Math.abs(offset) % segmentWidth);
                    }
                }

                track.style.transform = 'translate3d(' + offset + 'px, 0, 0)';
            }

            frameId = window.requestAnimationFrame(tick);
        }

        function setPaused(value) {
            paused = value;
            root.classList.toggle('is-paused', paused);
        }

        function restart() {
            speed = mobileView.matches ? 42 : 58;
            fillTrack();
            lastTime = 0;
        }

        function requestRestart() {
            if (resizeFrame) {
                window.cancelAnimationFrame(resizeFrame);
            }

            resizeFrame = window.requestAnimationFrame(function () {
                resizeFrame = null;
                restart();
            });
        }

        root.addEventListener('mouseenter', function () {
            setPaused(true);
        });

        root.addEventListener('mouseleave', function () {
            setPaused(false);
        });

        root.addEventListener('focusin', function () {
            setPaused(true);
        });

        root.addEventListener('focusout', function () {
            setPaused(false);
        });

        fillTrack();
        frameId = window.requestAnimationFrame(tick);

        if ('ResizeObserver' in window) {
            new ResizeObserver(requestRestart).observe(root);
        } else {
            window.addEventListener('resize', requestRestart);
        }

        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(requestRestart);
        }

        reduceMotion.addEventListener && reduceMotion.addEventListener('change', function (event) {
            if (event.matches && frameId) {
                window.cancelAnimationFrame(frameId);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-news-ticker]').forEach(setupTicker);
    });
})();
