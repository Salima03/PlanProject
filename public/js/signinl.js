// Si vous voulez une alternative sans CSS : Gérer l'affichage avec JS
document.querySelector('.hover-zone').addEventListener('mouseenter', () => {
    document.querySelector('.navbar').style.top = '0';
  });
  
  document.querySelector('.hover-zone').addEventListener('mouseleave', () => {
    document.querySelector('.navbar').style.top = '-100px';
  });
  



document.addEventListener("DOMContentLoaded", () => {
    console.log("Scripts loaded!");
  
    // Example: Adding an event listener for button clicks
    const btn = document.querySelector('.btn');
    if (btn) {
      btn.addEventListener('click', () => {
        alert('Button clicked!');
      });
    }
  });
  