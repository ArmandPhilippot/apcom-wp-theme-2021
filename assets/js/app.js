"use strict";

/**
 * showBackToTopOnScroll
 *
 * Determine scroll position to display or not the back to top link.
 */
function showBackToTopOnScroll() {
  const backToTop = document.getElementById('back-to-top');
  const scrollPosition = window.scrollY;

  if (scrollPosition < '300') {
    backToTop.style.display = 'none';
  } else {
    backToTop.style.display = 'block';
    backToTop.style.animation = 'fadeIn 1s';
  }
}
/**
 * Init the back to top button
 *
 * Hide the button by default then listen for scroll.
 */


function initBackToTopButton() {
  const html = document;
  const backToTop = document.getElementById('back-to-top');
  backToTop.style.display = 'none';
  html.addEventListener('scroll', () => showBackToTopOnScroll());
}

initBackToTopButton();
"use strict";

/**
 * Add automatically some classes and attributes.
 *
 * These classes and attributes are needed by Prism or to customize comments.
 */
function setCodeBlocksClasses() {
  const preTags = document.getElementsByTagName('pre');

  for (let i = 0; i < preTags.length; i++) {
    const preClasses = preTags[i].classList.length;
    preTags[i].tabIndex = '0';

    for (let j = 0; j < preClasses; j++) {
      if (preTags[i].classList[j].startsWith('language')) {
        if (!preTags[i].classList.contains('command-line') && !preTags[i].classList.contains('language-diff')) {
          preTags[i].classList.add('line-numbers');
        } else if (preTags[i].classList.contains('command-line') && preTags[i].classList.contains('filter-output')) {
          preTags[i].setAttribute('data-filter-output', '#output#');
        }
      } else if (preTags[i].classList.contains('instructions')) {
        const codeTag = preTags[i].firstChild;
        const codeLines = codeTag.innerHTML.split(/[\n\r]/g);
        const codeLinesLength = codeLines.length;

        for (let k = 0; k < codeLinesLength; k++) {
          if (/^\/\//.test(codeLines[k])) {
            const colorizeComment = '<span class="token comment">' + codeLines[k] + '</span>';
            codeTag.innerHTML = codeTag.innerHTML.replace(codeLines[k], colorizeComment);
          }
        }
      }
    }
  }
}
/**
 * Translate the PrismJS Copy to clipboard button.
 */


function translateCopyButton() {
  const pageContent = document.getElementById('page__content');

  if (pageContent) {
    pageContent.setAttribute('data-prismjs-copy', 'Copier');
    pageContent.setAttribute('data-prismjs-copy-success', 'Copié !');
    pageContent.setAttribute('data-prismjs-copy-error', 'Utilisez Ctrl+c pour copier');
  }
}

document.body.addEventListener('DOMContentLoaded', setCodeBlocksClasses());
translateCopyButton();
"use strict";

/* global color_scheme_vars */

/* global getThemePreference */

/* global updateColorScheme */

/**
 * Get the light theme icon to display on dark theme.
 */
function getLightThemeIcon() {
  const span = document.createElement('span');
  const sunIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M70 50a20 20 0 01-20 20 20 20 0 01-20-20 20 20 0 0120-20 20 20 0 0120 20zm28.557 1.16c2.74.07 1.192 12.435-1.48 11.819l-16.03-3.7c-2.67-.616-1.676-8.604 1.064-8.535zM79.931 89.565c1.695 2.156-9.31 8.877-10.44 6.38l-6.776-14.991c-1.13-2.499 5.358-6.48 7.051-4.324zM38.26 99.068c-.603 2.675-12.753-1.73-11.521-4.18l7.39-14.698c1.231-2.45 8.353.156 7.75 2.83zM4.81 72.51C2.362 73.741-1.81 61.508.864 60.905l16.049-3.619c2.674-.603 5.046 6.602 2.597 7.834zm-.02-43.073C2.34 28.205 9.394 17.36 11.47 19.15l12.465 10.737c2.077 1.79-1.997 8.172-4.448 6.94zm33.425-26.59C37.612.171 50.497-1.118 50.43 1.623l-.408 16.446c-.068 2.74-7.585 3.5-8.189.825zm41.655 9.446c1.686-2.163 10.761 7.085 8.598 8.77L75.49 31.172c-2.164 1.685-7.415-3.739-5.73-5.902zm18.686 38.419c2.74-.068 1.201 12.848-1.47 12.231l-16.029-3.7c-2.671-.616-1.687-8.056 1.053-8.124z"/></svg>';
  span.innerHTML = sunIcon;
  span.classList.add('tools__icon', 'tools__icon--light');
  span.setAttribute('aria-hidden', 'true');
  return span;
}
/**
 * Get the dark theme icon to display on light theme.
 */


function getDarkThemeIcon() {
  const span = document.createElement('span');
  const moonIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M51.283 0A45.12 45.12 0 0173.95 39.135a45.12 45.12 0 01-45.12 45.12 45.12 45.12 0 01-25.09-7.618A50.133 50.133 0 0046.126 100 50.133 50.133 0 0096.26 49.867 50.133 50.133 0 0051.283 0z"/></svg>';
  span.innerHTML = moonIcon;
  span.classList.add('tools__icon', 'tools__icon--dark');
  span.setAttribute('aria-hidden', 'true');
  return span;
}
/**
 * Get the light theme label to display on dark theme.
 */


function getDarkThemeLabel() {
  const span = document.createElement('span');
  const label = color_scheme_vars.lightThemeText;
  span.innerHTML = label;
  span.classList.add('tools__label--light', 'screen-reader-text');
  return span;
}
/**
 * Get the dark theme label to display on light theme.
 */


function getLightThemeLabel() {
  const span = document.createElement('span');
  const label = color_scheme_vars.darkThemeText;
  span.innerHTML = label;
  span.classList.add('tools__label--dark', 'screen-reader-text');
  return span;
}
/**
 * Detect if user prefers dark color scheme.
 */


function prefersDarkScheme() {
  if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    return true;
  }
}
/**
 * Update the preferred color scheme in local storage.
 *
 * @param {string} preference A color scheme, either `light` or `dark`.
 */


function updateThemePreference(preference) {
  localStorage.setItem('apcom-color-scheme', preference);
}
/**
 * Define the preferred color scheme based on local storage or browser settings.
 */


function defineThemePreference() {
  let colorScheme = '';

  if (getThemePreference()) {
    colorScheme = getThemePreference();
  } else if (prefersDarkScheme()) {
    colorScheme = 'dark';
  } else {
    colorScheme = 'light';
  }

  updateThemePreference(colorScheme);
}
/**
 * Switch the theme based on the current color scheme and update stored
 * preference.
 */


function switchColorScheme() {
  const body = document.getElementById('body');

  if (body.getAttribute('data-color-scheme') === 'light') {
    updateThemePreference('dark');
  } else if (body.getAttribute('data-color-scheme') === 'dark') {
    updateThemePreference('light');
  }

  updateColorScheme();
}
/**
 * Create a button to switch between color schemes.
 */


function createSwitchThemeButton() {
  const preferredColorScheme = getThemePreference();
  const toolsBar = document.getElementById('tools');
  const toolsBarFirstChild = toolsBar.firstChild;
  const toggleDiv = document.createElement('div');
  const switchButton = document.createElement('button');
  let switchButtonIcon = '';
  let switchButtonLabel = '';
  toggleDiv.classList.add('tools__item', 'themes');
  toggleDiv.title = color_scheme_vars.title;

  if (preferredColorScheme === 'dark') {
    switchButtonLabel = getLightThemeLabel();
    switchButtonIcon = getLightThemeIcon();
  } else {
    switchButtonLabel = getDarkThemeLabel();
    switchButtonIcon = getDarkThemeIcon();
  }

  switchButton.id = 'switch-theme';
  switchButton.classList.add('tools__label', 'tools__btn');
  switchButton.type = 'button';
  switchButton.appendChild(switchButtonLabel);
  switchButton.appendChild(switchButtonIcon);
  toggleDiv.appendChild(switchButton);
  toolsBar.insertBefore(toggleDiv, toolsBarFirstChild);
}
/**
 * Update the button content when user switch theme.
 */


function updateSwitchThemeButton() {
  const preferredColorScheme = getThemePreference();
  const toggleButton = document.getElementById('switch-theme');
  let switchButtonIcon = '';
  let switchButtonLabel = '';
  toggleButton.innerHTML = '';

  if (preferredColorScheme === 'dark') {
    switchButtonLabel = getLightThemeLabel();
    switchButtonIcon = getLightThemeIcon();
  } else {
    switchButtonLabel = getDarkThemeLabel();
    switchButtonIcon = getDarkThemeIcon();
  }

  toggleButton.appendChild(switchButtonLabel);
  toggleButton.appendChild(switchButtonIcon);
}
/**
 * Initialize the theme to use based on user preferences.
 */


function initializeColorScheme() {
  defineThemePreference();
  createSwitchThemeButton();
  updateColorScheme();
}
/**
 * Apply the theme to all tabs.
 */


function syncColorSchemeBetweenTabs() {
  const body = document.getElementById('body');
  body.addEventListener('storage', e => {
    if (e.key === 'apcom-color-scheme') {
      updateColorScheme();
      updateSwitchThemeButton();
    }
  });
}

initializeColorScheme();
syncColorSchemeBetweenTabs();
document.getElementById('switch-theme').addEventListener('click', () => {
  switchColorScheme();
  updateSwitchThemeButton();
});
"use strict";

/* global date_warning */

/**
 * Check if the diff between two dates is longer than two years.
 *
 * @param {number} firstDate A date in milliseconds.
 * @param {number} secondDate A date in milliseconds.
 * @return {boolean} True if the diff is greater than two years.
 */
const isMoreThanTwoYears = (firstDate, secondDate) => {
  const diffInMilliseconds = firstDate > secondDate ? firstDate - secondDate : secondDate - firstDate;
  const diffInDays = diffInMilliseconds / (1000 * 60 * 60 * 24);
  const twoYears = 365 * 2;
  return diffInDays > twoYears;
};
/**
 * Insert a new HTML element above the page content.
 *
 * @param {HTMLElement} node An HTML element to insert.
 */


const insertBeforeContent = node => {
  const pageContent = document.getElementById('page__content');
  const firstChild = pageContent.firstChild;
  pageContent.insertBefore(node, firstChild);
};
/**
 * Check if the current page is an article.
 *
 * @return {boolean} True if it is an article.
 */


const isArticle = () => {
  const body = document.getElementById('body');
  return body.classList.contains('single-page') && !body.classList.contains('cpt') && !body.classList.contains('no-comments');
};
/**
 * Get warning message.
 *
 * @return {string} The translated warning message.
 */


const getWarning = () => {
  return date_warning.beAware + ' ' + date_warning.oldContent + ' ' + date_warning.noMoreValid + ' ' + date_warning.contentEvolved;
};
/**
 * Get the publication date of an article.
 *
 * @return {Date} Date element or null.
 */


const getPublicationDate = () => {
  const publicationDateWrapper = document.getElementById('meta__publication-date');
  return publicationDateWrapper ? new Date(publicationDateWrapper.dateTime).getTime() : null;
};
/**
 * Get the update date of an article.
 *
 * @return {Date} Date element or null
 */


const getUpdateDate = () => {
  const updateDateWrapper = document.getElementById('meta__update-date');
  return updateDateWrapper ? new Date(updateDateWrapper.dateTime).getTime() : null;
};
/**
 * Display a warning if an article is not updated since more than two years.
 */


const displayWarningIfNeeded = () => {
  if (isArticle()) {
    const publicationDate = getPublicationDate();
    const updateDate = getUpdateDate();
    const currentDate = new Date().getTime();

    if (!publicationDate || !isMoreThanTwoYears(publicationDate, currentDate)) {
      return;
    }

    if (updateDate && !isMoreThanTwoYears(publicationDate, updateDate)) {
      return;
    }

    const div = document.createElement('div');
    div.classList.add('content-warning');
    div.innerHTML = getWarning();
    insertBeforeContent(div);
  }
};

displayWarningIfNeeded();
"use strict";

/**
 * Reading progress
 *
 * Represents a progress bar to indicate reading progression based on scroll position.
 *
 * @license MIT <https://opensource.org/licenses/MIT>
 * @author Armand Philippot <https://www.armandphilippot.com>
 */
class readingProgress {
  /**
   * Define the progress bar container.
   *
   * @param {string} containerId Id of the container.
   */
  constructor(containerId) {
    this.container = containerId ? document.getElementById(containerId) : '';
    this.progressBarWrapper = document.createElement('div');
    this.progressBar = document.createElement('div');
  }
  /**
   * Define the progress bar classes.
   *
   * @param {Array} barClasses - One or more classes for the progress bar.
   */


  setProgressBarClasses(barClasses) {
    if (barClasses) {
      barClasses.forEach(className => {
        this.progressBar.classList.add(className);
      });
    } else {
      this.progressBar.classList.add('reading-progress__bar');
    }
  }
  /**
   * Define the progress bar wrapper classes.
   *
   * @param {Array} wrapperClasses - One or more classes for the progress bar wrapper.
   */


  setProgressBarWrapperClasses(wrapperClasses) {
    if (wrapperClasses) {
      wrapperClasses.forEach(className => {
        this.progressBarWrapper.classList.add(className);
      });
    } else {
      this.progressBarWrapper.classList.add('reading-progress');
    }
  }
  /**
   * Insert the progress bar inside the container.
   *
   * @param {string} position - The progress bar position: `top` or `bottom` of its container.
   */


  insertReadingProgressBar(position) {
    this.progressBar.style.height = '100%';
    this.progressBar.style.maxWidth = '100%';
    this.progressBarWrapper.appendChild(this.progressBar);
    this.progressBarWrapper.style.position = 'sticky';

    if (position === 'bottom') {
      this.container.appendChild(this.progressBarWrapper);
      this.progressBarWrapper.style.bottom = '0';
    } else {
      if (!this.container) {
        return;
      }

      const containerFirstChild = this.container.firstChild;
      this.container.insertBefore(this.progressBarWrapper, containerFirstChild);
      this.progressBarWrapper.style.top = '0';
    }
  }
  /**
   * Display or not the progress bar.
   *
   * @param {boolean} bool - True of false.
   */


  showProgressBar(bool) {
    if (bool === true) {
      this.progressBarWrapper.style.display = 'block';
    } else {
      this.progressBarWrapper.style.display = 'none';
    }
  }
  /**
   * Calculate the distance traveled as a percentage without unit.
   *
   * @param {string} recordFrom - An element to use for the calculation: `body` for the whole page, `container` for its container or an ID.
   * @return {number} A percentage without unit.
   */


  getScrollPercent(recordFrom) {
    let target = '';

    if (recordFrom === 'body') {
      target = document.body;
    } else if (typeof recordFrom === 'string' && recordFrom !== 'container') {
      target = document.getElementById(recordFrom);
    } else {
      target = this.container;
    }

    if (!target) {
      return;
    }

    const windowHeight = window.innerHeight;
    const windowTop = window.scrollY;
    const targetHeight = target.offsetHeight;
    const targetTop = target.offsetTop;
    const scrollPercent = (windowTop - targetTop) / (targetHeight - windowHeight) * 100;
    return scrollPercent;
  }
  /**
   * Use the distance traveled as progressBar width.
   *
   * @param {string} recordFrom - An element to use for the calculation: `body` for the whole page, `container` for its container or an ID.
   */


  recordProgression(recordFrom) {
    const scrollPercent = this.getScrollPercent(recordFrom);

    if (scrollPercent > 1 && scrollPercent <= 100) {
      this.showProgressBar(true);
    } else {
      this.showProgressBar(false);
    }

    this.progressBar.style.width = scrollPercent + '%';
  }
  /**
   * Initialize the reading progress bar.
   *
   * @param {Array}  wrapperClasses - One or more classes for the progress bar wrapper. Default: `['reading-progress']`.
   * @param {Array}  barClasses - One or more classes for the progress bar. Default `['reading-progress__bar']`.
   * @param {string} position - The progress bar position: `top` or `bottom` of its container. Default: `top`.
   * @param {string} recordFrom - An element to use for the calculation: `body` for the whole page, `container` for its container or an ID. Default `container`.
   */


  init(wrapperClasses = ['reading-progress'], barClasses = ['reading-progress__bar'], position = 'top', recordFrom = 'container') {
    if (this.container !== '') {
      this.setProgressBarWrapperClasses(wrapperClasses);
      this.setProgressBarClasses(barClasses);
      this.insertReadingProgressBar(position);
      this.recordProgression(recordFrom);
    }
  }

}
/**
 * Init the reading progress bar depending on the current page.
 */


function initReadingProgress() {
  const html = document;
  const bodyClasses = document.body.classList;

  if (bodyClasses.contains('single-page') && !bodyClasses.contains('attachment')) {
    const APComScrollBar = new readingProgress('page__content');
    html.addEventListener('scroll', () => {
      APComScrollBar.init();
    });
  }
}

initReadingProgress();
"use strict";

/* eslint-disable @wordpress/no-global-event-listener */

/**
 * Get the viewport width based on the window width.
 *
 * @return {number} The window inner width.
 */
function getViewportWidth() {
  return window.innerWidth;
}
/**
 * Hide search input when user click outside or focus move outside search form.
 *
 * @param {*} target Event target
 */


function hideSearch(target) {
  const toolSearch = document.getElementById('tools__search');
  const searchCheckbox = document.getElementById('search__checkbox');

  if (!toolSearch.contains(target) && target !== null) {
    searchCheckbox.checked = false;
  }
}
/**
 * Create an Intersection Observer to observe visibility of element objects.
 *
 * @param {*} element An array of elements or a single HTMLElement.
 * @param {*} callback A function which is called when the targeted element is visible.
 */


function createVisibilityObserver(element, callback) {
  const options = {};

  const intersectionCallback = entries => {
    entries.forEach(entry => {
      callback(entry.intersectionRatio > 0);
    });
  };

  const observer = new IntersectionObserver(intersectionCallback, options);
  observer.observe(element);
}
/**
 * Call the Intersection Observer to prevent or allow scrolling.
 *
 * @param {*} element An array of elements or a single HTMLElement.
 */


function observeDisplayChange(element) {
  createVisibilityObserver(element, visible => {
    const viewportWidth = getViewportWidth();

    if (visible && viewportWidth < 1280) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.removeProperty('overflow');
    }
  });
}
/**
 * Handle visibility and overflow with event listeners.
 */


function initSearch() {
  const toolSearch = document.getElementById('tools__search');
  const searchForm = toolSearch.getElementsByClassName('search-form')[0];
  window.addEventListener('load', () => {
    observeDisplayChange(searchForm);
  });
  window.addEventListener('resize', () => {
    observeDisplayChange(searchForm);
  });
  document.body.addEventListener('click', event => {
    hideSearch(event.target);
  });
  document.body.addEventListener('focusout', event => {
    hideSearch(event.relatedTarget);
  });
}

initSearch();
"use strict";

/**
 * Minimalist ToC
 *
 * A minimalist table of contents in Javascript.
 *
 * @author Armand Philippot <contact@armandphilippot.com>
 */

/* global toc_args */

/**
 * Convert a text into a slug or id.
 * https://gist.github.com/codeguy/6684588#gistcomment-3332719
 *
 * @param {string} text Text to slugify.
 */
const slugify = text => {
  return text.toString().normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '-').replace(/\-\-+/g, '-').replace(/^-|-$/g, '');
};

class TableOfContent {
  constructor() {
    this.source = '';
    this.target = '';
    this.options = {
      headings: ['h2', 'h3', 'h4', 'h5', 'h6'],
      title: 'Table of contents',
      titleTag: 'h2',
      listType: 'ol'
    };
  }

  setSource(source) {
    if (source && typeof source === 'string') {
      this.source = document.getElementById(source);
    }
  }

  setTarget(target) {
    if (target && typeof target === 'string') {
      this.target = document.getElementById(target);
    }
  }

  setOptions(options) {
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

  getHeadingList() {
    const allTitles = this.source.querySelectorAll(this.options.headings);
    const titlesWithoutLinks = [...allTitles].filter(title => !title.firstElementChild || 'A' !== title.firstElementChild.tagName);
    const commentsTitle = document.getElementById('comments__title');

    if (commentsTitle) {
      titlesWithoutLinks.push(commentsTitle);
    }

    return titlesWithoutLinks;
  }

  createTitleMarkup() {
    return '<' + this.options.titleTag + ' id="toc-title">' + this.options.title + '</' + this.options.titleTag + '>';
  }

  startListNode() {
    return '<' + this.options.listType + '>';
  }

  endListNode() {
    return '</' + this.options.listType + '>';
  }

  determineLevel(currentHeading) {
    return this.options.headings.indexOf(currentHeading);
  }

  calculateLevelDiff(currentLevel, previousLevel) {
    return currentLevel - previousLevel;
  }

  addSlug(heading) {
    heading.id = heading.id ? heading.id : slugify(heading.innerText);
    return heading.id;
  }

  createTocMarkup() {
    let levelDiff;
    const headingList = this.getHeadingList();
    let i = 0;
    let markup = '';
    let currentLevel;
    let previousLevel = currentLevel;
    markup += '<nav class="toc" aria-labelledby="toc-title">';
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

      if ('comments__title' === headingList[i].id) {
        markup += '<a href="#' + this.addSlug(headingList[i]) + '">' + toc_args.commentTitle + '</a>';
      } else {
        markup += '<a href="#' + this.addSlug(headingList[i]) + '">' + headingList[i].innerText + '</a>';
      }

      previousLevel = currentLevel;
    }

    markup += '</li>';
    markup += this.endListNode();
    markup += '</nav>';
    return markup;
  }

  printToc() {
    const headingList = this.getHeadingList();

    if (headingList.length > 0) {
      this.target.innerHTML = this.createTocMarkup();
    }
  }
  /**
   * Initialize the table of content.
   *
   * @param {string} source The container id to look for headings.
   * @param {string} target The container id to display the table of content.
   * @param {Object} options Options.
   *
   * Options list :
   * - headings: an array of headings to retrieve. Default : `['h2', 'h3', 'h4', 'h5', 'h6']`
   * - title: the title to print before the table of contents. Default: `Table of contents`.
   * - titleTag: the title tag. Default: `h2`.
   * - listType: the list type (`ul` or `ol`). Default: `ol`.
   */


  init(source, target, options) {
    this.setSource(source);
    this.setTarget(target);
    this.setOptions(options);

    if (this.source && this.target) {
      this.printToc();
    }
  }

}

const minimalistTOC = new TableOfContent();
minimalistTOC.init('page__content', 'table-of-content', {
  title: toc_args.tocTitle
});