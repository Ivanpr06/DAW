function toggleMenuIcon(button) {
    const menuIcon = document.getElementById('menuIcon');
    const isExpanded = button.getAttribute('aria-expanded') === 'true';
    
    if (isExpanded) {
        menuIcon.classList.add('closing');
    } else {
        menuIcon.classList.add('opening');
    }
    
    setTimeout(() => {
        if (isExpanded) {
            menuIcon.src = "../Img/cruz.png";
            menuIcon.alt = "Cerrar menú";
            menuIcon.classList.remove('closing');
            menuIcon.classList.add('opening');
        } else {
            menuIcon.src = "../Img/toggle.png";
            menuIcon.alt = "Abrir menú";
            menuIcon.classList.remove('opening');
            menuIcon.classList.add('closing');
        }
        
        setTimeout(() => {
            menuIcon.classList.remove('opening', 'closing');
        }, 50);
        
    }, 225);
}
