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