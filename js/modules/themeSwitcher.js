class themeSwitcher {

  constructor() {
    this.themeSwitcher = document.querySelector('#theme-switcher');
    this.themeSwitcher.addEventListener('click', this.toggleTheme.bind(this));
  }

  toggleTheme() {
    document.body.classList.toggle('dark');
  }
}

export default themeSwitcher;