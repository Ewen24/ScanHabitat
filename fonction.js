window.addEventListener("DOMContentLoaded",(e)=>{
    const burger=document.getElementById("imageHamburger")
    const fermer=document.getElementById("fermer")
    const barre_nav=document.getElementById("barre_nav")



    function AfficherMenu(barre_nav){

        barre_nav.style.display = "block"
        
    }

    function FermerMenu(barre_nav){
        barre_nav.style.display = "none"
        
    }

    burger.addEventListener("click",(event)=>{
        AfficherMenu(barre_nav)

    })
    fermer.addEventListener("click",(event)=>{
        FermerMenu(barre_nav)
    })

})



