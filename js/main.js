function initializeStickyHeader() {
  // initialise elements
  let stickyHeader = document.getElementById('sticky-header');
  let stickyPlaceholder = document.getElementById('sticky-header-placeholder');
  stickyPlaceholder.style.height = stickyHeader.getBoundingClientRect().height + 'px';

  // sticky logic
  document.addEventListener('scroll', () => {
    if (stickyHeader.getBoundingClientRect().top <= 0) {
      stickyPlaceholder.style.display = "block";

      stickyHeader.classList.remove('sticky-inactive');
      stickyHeader.classList.add('sticky-active');
    }
    if (stickyPlaceholder.getBoundingClientRect().top > 0) {
      stickyPlaceholder.style.display = "none";

      stickyHeader.classList.remove('sticky-active');
      stickyHeader.classList.add('sticky-inactive');
    }
  });
}

function initialiseHeaderLinks() {
  let links = document.getElementsByClassName("inner-header-container");
  for (let index = 0; index < links.length; ++index) {
    links[index].addEventListener('mouseenter', () => {
      links[index].classList.add("hovered-inner-header-container");
    });
    links[index].addEventListener('mouseleave', () => {
      links[index].classList.remove("hovered-inner-header-container");
    });
  }
}

function initialiseUserDropdown() {
  let userInfo = document.getElementById("user-info");
  if (!userInfo) {
    return;
  }
  userInfo.addEventListener("click", () => {
    let dropdownArrows = userInfo.getElementsByClassName("dropdown-arrow");
    // Dropdown is active, collapse it
    if (userInfo.classList.contains("dropdown-expanded")) {
      userInfo.classList.remove("dropdown-expanded");
      userInfo.classList.add("dropdown-collapsed");
      for (let index = 0; index < dropdownArrows.length; ++index) {
        dropdownArrows[index].classList.remove("up");
        dropdownArrows[index].classList.add("down");
      }
      dropdownContainers = userInfo.getElementsByClassName("user-dropdown");
      for (let index = 0; index < dropdownArrows.length; ++index) {
        dropdownContainers[index].classList.remove("user-dropdown-expanded");
        dropdownContainers[index].classList.add("user-dropdown-collapsed");
      }
    }
    // Dropdown is inactive, expand it
    else {
      userInfo.classList.remove("dropdown-collapsed");
      userInfo.classList.add("dropdown-expanded");
      for (let index = 0; index < dropdownArrows.length; ++index) {
        dropdownArrows[index].classList.remove("down");
        dropdownArrows[index].classList.add("up");
      }
      dropdownContainers = userInfo.getElementsByClassName("user-dropdown");
      for (let index = 0; index < dropdownArrows.length; ++index) {
        dropdownContainers[index].classList.remove("user-dropdown-collapsed");
        dropdownContainers[index].classList.add("user-dropdown-expanded");
      }
    }
  });
}

// Extra
function initialiseLinks() {
  let links = document.getElementsByTagName("a");
  for (let index = 0; index < links.length; ++index) {
    links[index].addEventListener('mouseenter', () => {
      links[index].classList.add("hovered-link");
    });
    links[index].addEventListener('mouseleave', () => {
      links[index].classList.remove("hovered-link");
    });
  }
}

function initialiseButtons() {
  let buttons = document.getElementsByTagName("button");
  for (let index = 0; index < buttons.length; ++index) {
    buttons[index].addEventListener('mouseenter', () => {
      buttons[index].classList.add("hovered-button");
    });
    buttons[index].addEventListener('mouseleave', () => {
      buttons[index].classList.remove("hovered-button");
    });
  }
}
//

function doNotCallThis() {
  document.addEventListener("scroll", () => {
    elements = document.getElementsByTagName('*');
    for (let index = 0; index < elements.length; index++) {
      elements[index].style = "background-color: #" + Math.floor(Math.random() * 16777215).toString(16) + "; color: #" + Math.floor(Math.random() * 16777215).toString(16) + ";";
    }
  });
}

function mainJs(){
  // doNotCallThis();
  initializeStickyHeader();
  initialiseHeaderLinks();
  initialiseUserDropdown();
  // Extra
  initialiseLinks();
  initialiseButtons();
  //
}
