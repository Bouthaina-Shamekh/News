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

        function removeClones() {
            track.querySelectorAll('[data-ticker-clone="true"]').forEach(function (clone) {
                clone.remove();
            });
        }

        function fillTrack() {
            var minimumWidth = root.clientWidth * 2;

            removeClones();
            track.style.transform = 'translate3d(0, 0, 0)';
            segmentWidth = track.scrollWidth;

            if (!segmentWidth) {
                return;
            }

            do {
                cloneItems(originalItems).forEach(function (clone) {
                    track.appendChild(clone);
                });
            } while (track.scrollWidth < minimumWidth + segmentWidth);

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
                        offset -= segmentWidth;
                    }
                } else {
                    offset -= speed * delta;

                    if (offset <= -segmentWidth) {
                        offset += segmentWidth;
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
            new ResizeObserver(restart).observe(root);
        } else {
            window.addEventListener('resize', restart);
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
