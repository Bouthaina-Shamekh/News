(function () {
    'use strict';

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    var mobileView = window.matchMedia('(max-width: 768px)');

    function setupTicker(root) {
        var track = root.querySelector('[data-news-ticker-track]');
        var groups = root.querySelectorAll('[data-news-ticker-group]');

        if (!track || groups.length < 2) {
            return;
        }

        function syncShortGroups() {
            var firstGroup = groups[0];
            var secondGroup = groups[1];
            var originalItems = Array.prototype.slice.call(firstGroup.querySelectorAll('li:not([data-ticker-extra])'));

            firstGroup.querySelectorAll('[data-ticker-extra="true"]').forEach(function (item) {
                item.remove();
            });

            secondGroup.querySelectorAll('[data-ticker-extra="true"]').forEach(function (item) {
                item.remove();
            });

            if (!originalItems.length) {
                return;
            }

            while (firstGroup.scrollWidth < root.clientWidth) {
                originalItems.forEach(function (item) {
                    var firstClone = item.cloneNode(true);
                    var secondClone = item.cloneNode(true);

                    firstClone.setAttribute('data-ticker-extra', 'true');
                    secondClone.setAttribute('data-ticker-extra', 'true');
                    secondClone.querySelectorAll('a, button, input, select, textarea').forEach(function (focusable) {
                        focusable.setAttribute('tabindex', '-1');
                    });

                    firstGroup.appendChild(firstClone);
                    secondGroup.appendChild(secondClone);
                });
            }
        }

        function setDuration() {
            var groupWidth = groups[0].scrollWidth;
            var speed = mobileView.matches ? 70 : 100;
            var duration = Math.max(28, Math.round(groupWidth / speed));

            track.style.setProperty('--ticker-duration', duration + 's');
        }

        function refresh() {
            syncShortGroups();
            setDuration();
        }

        refresh();

        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(refresh);
        }

        if ('ResizeObserver' in window) {
            new ResizeObserver(refresh).observe(root);
        } else {
            window.addEventListener('resize', refresh);
        }

        if (reduceMotion.matches) {
            track.style.animation = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-news-ticker]').forEach(setupTicker);
    });
})();
