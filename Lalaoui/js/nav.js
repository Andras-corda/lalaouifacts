const checkbox = document.getElementById('menu-toggle');
  checkbox.addEventListener('change', function () {
    const menuItems = document.querySelector('.menu-items');
    if (this.checked) {
      menuItems.style.transform = 'translateX(0)';
    } else {
      menuItems.style.transform = 'translateX(-150%)';
    }
  });