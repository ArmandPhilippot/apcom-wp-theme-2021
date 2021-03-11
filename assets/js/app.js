"use strict";

var backToTop = document.getElementById('back-to-top');
backToTop.style.display = 'none';
/**
 * showBackToTopOnScroll
 *
 * Determine scroll position to display or not the back to top link.
 */

function showBackToTopOnScroll() {
  var scrollPosition = window.scrollY;

  if (scrollPosition < '300') {
    backToTop.style.display = 'none';
  } else {
    backToTop.style.display = 'block';
    backToTop.style.animation = 'fadeIn 1s';
  }
}

window.addEventListener('scroll', function () {
  return showBackToTopOnScroll();
});
"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * Reading progress
 *
 * Represents a progress bar to indicate reading progression based on scroll position.
 *
 * @license MIT <https://opensource.org/licenses/MIT>
 * @author Armand Philippot <https://www.armandphilippot.com>
 */
var readingProgress = /*#__PURE__*/function () {
  /**
   * Define the progress bar container.
   * @param {string} containerId Id of the container.
   */
  function readingProgress(containerId) {
    _classCallCheck(this, readingProgress);

    this.container = containerId ? document.getElementById(containerId) : '';
    this.progressBarWrapper = document.createElement('div');
    this.progressBar = document.createElement('div');
  }
  /**
   * Define the progress bar classes.
   * @param {array} barClasses - One or more classes for the progress bar.
   */


  _createClass(readingProgress, [{
    key: "setProgressBarClasses",
    value: function setProgressBarClasses(barClasses) {
      var _this = this;

      if (barClasses) {
        barClasses.forEach(function (className) {
          _this.progressBar.classList.add(className);
        });
      } else {
        this.progressBar.classList.add('reading-progress__bar');
      }
    }
    /**
     * Define the progress bar wrapper classes.
     * @param {array} wrapperClasses - One or more classes for the progress bar wrapper.
     */

  }, {
    key: "setProgressBarWrapperClasses",
    value: function setProgressBarWrapperClasses(wrapperClasses) {
      var _this2 = this;

      if (wrapperClasses) {
        wrapperClasses.forEach(function (className) {
          _this2.progressBarWrapper.classList.add(className);
        });
      } else {
        this.progressBarWrapper.classList.add('reading-progress');
      }
    }
    /**
     * Insert the progress bar inside the container.
     * @param {string} position - The progress bar position: `top` or `bottom` of its container.
     */

  }, {
    key: "insertReadingProgressBar",
    value: function insertReadingProgressBar(position) {
      this.progressBar.style.height = '100%';
      this.progressBar.style.maxWidth = '100%';
      this.progressBarWrapper.appendChild(this.progressBar);
      this.progressBarWrapper.style.position = 'sticky';

      if (position === 'bottom') {
        this.container.appendChild(this.progressBarWrapper);
        this.progressBarWrapper.style.bottom = '0';
      } else {
        var containerFirstChild = this.container.firstChild;
        this.container.insertBefore(this.progressBarWrapper, containerFirstChild);
        this.progressBarWrapper.style.top = '0';
      }
    }
    /**
     * Display or not the progress bar.
     * @param {boolean} bool - True of false.
     */

  }, {
    key: "showProgressBar",
    value: function showProgressBar(bool) {
      if (bool === true) {
        this.progressBarWrapper.style.display = 'block';
      } else {
        this.progressBarWrapper.style.display = 'none';
      }
    }
    /**
     * Calculate the distance traveled as a percentage without unit.
     * @param {string} recordFrom - An element to use for the calculation: `body` for the whole page, `container` for its container or an ID.
     * @return {number} A percentage without unit.
     */

  }, {
    key: "getScrollPercent",
    value: function getScrollPercent(recordFrom) {
      var target = '';

      if (recordFrom === 'body') {
        target = document.body;
      } else if (typeof recordFrom === 'string' && recordFrom !== 'container') {
        target = document.getElementById(recordFrom);
      } else {
        target = this.container;
      }

      var windowHeight = window.innerHeight;
      var windowTop = window.scrollY;
      var targetHeight = target.offsetHeight;
      var targetTop = target.offsetTop;
      var scrollPercent = (windowTop - targetTop) / (targetHeight - windowHeight) * 100;
      return scrollPercent;
    }
    /**
     * Use the distance traveled as progressBar width.
     * @param {string} recordFrom - An element to use for the calculation: `body` for the whole page, `container` for its container or an ID.
     */

  }, {
    key: "recordProgression",
    value: function recordProgression(recordFrom) {
      var scrollPercent = this.getScrollPercent(recordFrom);

      if (scrollPercent > 1 && scrollPercent <= 100) {
        this.showProgressBar(true);
      } else {
        this.showProgressBar(false);
      }

      this.progressBar.style.width = scrollPercent + '%';
    }
    /**
     * Initialize the reading progress bar.
     * @param {array}  wrapperClasses - One or more classes for the progress bar wrapper. Default: `['reading-progress']`.
     * @param {array}  barClasses - One or more classes for the progress bar. Default `['reading-progress__bar']`.
     * @param {string} position - The progress bar position: `top` or `bottom` of its container. Default: `top`.
     * @param {string} recordFrom - An element to use for the calculation: `body` for the whole page, `container` for its container or an ID. Default `container`.
     */

  }, {
    key: "init",
    value: function init() {
      var wrapperClasses = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : ['reading-progress'];
      var barClasses = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : ['reading-progress__bar'];
      var position = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'top';
      var recordFrom = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 'container';

      if (this.container !== '') {
        this.setProgressBarWrapperClasses(wrapperClasses);
        this.setProgressBarClasses(barClasses);
        this.insertReadingProgressBar(position);
        this.recordProgression(recordFrom);
      }
    }
  }]);

  return readingProgress;
}();

var bodyClasses = document.body.classList;

if (bodyClasses.contains('single-page') && !bodyClasses.contains('attachment')) {
  var APComScrollBar = new readingProgress('page__content');
  document.addEventListener('scroll', function () {
    APComScrollBar.init();
  });
}
"use strict";

/**
 * hideSearch
 *
 * Hide search input when user click outside or focus move outside search form.
 *
 * @param {*} target Event target
 */
function hideSearch(target) {
  var menuItemSearch = document.getElementById('tools__search');
  var searchCheckbox = document.getElementById('search__checkbox');

  if (!menuItemSearch.contains(target) && target !== null) {
    searchCheckbox.checked = false;
  }
}

document.addEventListener('click', function (event) {
  hideSearch(event.target);
});
document.addEventListener('focusout', function (event) {
  hideSearch(event.relatedTarget);
});
"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * Minimalist ToC
 *
 * A minimalist table of contents in Javascript.
 *
 * @author Armand Philippot <contact@armandphilippot.com>
 */

/**
 * Convert a text into a slug or id.
 *
 * @see: https://gist.github.com/codeguy/6684588#gistcomment-3332719
 *
 * @param {String} text Text to slugify.
 */
var slugify = function slugify(text) {
  return text.toString().normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '-').replace(/\-\-+/g, '-').replace(/^-|-$/g, '');
};

var TableOfContent = /*#__PURE__*/function () {
  function TableOfContent() {
    _classCallCheck(this, TableOfContent);

    this.source = '';
    this.target = '';
    this.options = {
      headings: ['h2', 'h3', 'h4', 'h5', 'h6'],
      title: 'Table of contents',
      titleTag: 'h2',
      listType: 'ol'
    };
  }

  _createClass(TableOfContent, [{
    key: "setSource",
    value: function setSource(source) {
      if (source && typeof source === 'string') {
        this.source = document.getElementById(source);
      }
    }
  }, {
    key: "setTarget",
    value: function setTarget(target) {
      if (target && typeof target === 'string') {
        this.target = document.getElementById(target);
      }
    }
  }, {
    key: "setOptions",
    value: function setOptions(options) {
      if (options) {
        if (options.headings && options.headings instanceof Array) {
          this.options.headings = options.headings;
        }

        if (options.title && typeof options.title === 'string') {
          this.options.title = options.title;
        }

        if (options.titleTag && typeof options.titleTag === 'string') {
          this.options.titleTag = options.titleTag;
        }

        if (options.listType && typeof options.listType === 'string') {
          this.options.listType = options.listType;
        }
      }
    }
  }, {
    key: "getHeadingList",
    value: function getHeadingList() {
      return this.source.querySelectorAll(this.options.headings);
    }
  }, {
    key: "createTitleMarkup",
    value: function createTitleMarkup() {
      return '<' + this.options.titleTag + '>' + this.options.title + '</' + this.options.titleTag + '>';
    }
  }, {
    key: "startListNode",
    value: function startListNode() {
      return '<' + this.options.listType + '>';
    }
  }, {
    key: "endListNode",
    value: function endListNode() {
      return '</' + this.options.listType + '>';
    }
  }, {
    key: "determineLevel",
    value: function determineLevel(currentHeading) {
      return this.options.headings.indexOf(currentHeading);
    }
  }, {
    key: "calculateLevelDiff",
    value: function calculateLevelDiff(currentLevel, previousLevel) {
      return currentLevel - previousLevel;
    }
  }, {
    key: "addSlug",
    value: function addSlug(heading) {
      heading.id = heading.id ? heading.id : slugify(heading.innerText);
      return heading.id;
    }
  }, {
    key: "createTocMarkup",
    value: function createTocMarkup() {
      var levelDiff;
      var headingList = this.getHeadingList();
      var i = 0;
      var markup = '';
      var currentLevel;
      var previousLevel = currentLevel;
      markup += '<nav class="toc">';
      markup += this.createTitleMarkup();
      markup += this.startListNode();

      for (i; i < headingList.length; i++) {
        currentLevel = this.determineLevel(headingList[i].localName);
        levelDiff = this.calculateLevelDiff(currentLevel, previousLevel);

        if (levelDiff < 0) {
          while (levelDiff < 0) {
            markup += this.endListNode();
            levelDiff++;
          }
        } else if (levelDiff > 0) {
          while (levelDiff > 0) {
            markup += this.startListNode();
            levelDiff--;
          }
        }

        if (i !== 0) {
          markup += '</li>';
        }

        markup += '<li>';
        markup += '<a href="#' + this.addSlug(headingList[i]) + '">' + headingList[i].innerText + '</a>';
        previousLevel = currentLevel;
      }

      markup += '</li>';
      markup += this.endListNode();
      markup += '</nav>';
      return markup;
    }
  }, {
    key: "printToc",
    value: function printToc() {
      var headingList = this.getHeadingList();

      if (headingList.length > 0) {
        this.target.innerHTML = this.createTocMarkup();
      }
    }
    /**
     * Initialize the table of content.
     *
     * @param {String} source The container id to look for headings.
     * @param {String} target The container id to display the table of content.
     * @param {Object} options Options.
     *
     * Options list :
     * - headings: an array of headings to retrieve. Default : `['h2', 'h3', 'h4', 'h5', 'h6']`
     * - title: the title to print before the table of contents. Default: `Table of contents`.
     * - titleTag: the title tag. Default: `h2`.
     * - listType: the list type (`ul` or `ol`). Default: `ol`.
     */

  }, {
    key: "init",
    value: function init(source, target, options) {
      this.setSource(source);
      this.setTarget(target);
      this.setOptions(options);

      if (this.source && this.target) {
        this.printToc();
      }
    }
  }]);

  return TableOfContent;
}();

var Minimalist_TOC = new TableOfContent();
Minimalist_TOC.init('page__content', 'table-of-content');