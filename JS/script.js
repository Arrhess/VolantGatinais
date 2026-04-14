const boxs = document.querySelectorAll(".equipe");
let dragged;

for (let equipe of boxs)
{

    equipe.ondragstart = (e) =>
    {
        dragged = equipe;
        e.dataTransfer.setData("text/plain",equipe.innerHTML);
        equipe.classList.add("dragged");
    };

    equipe.ondragover = (e) =>
    {
        e.preventDefault();
    };

    equipe.ondragenter = () =>
    {
        equipe.classList.add("drop");
    };

    equipe.ondragleave = () =>
    {
        equipe.classList.remove("drop");
    };

    equipe.ondragend = () =>
    {
        equipe.classList.remove("dragged");
    };

    equipe.ondrop = (e) =>
    {
/*         dragged.innerHTML = equipe.innerHTML; */
        equipe.innerHTML = e.dataTransfer.getData("text/plain");
        equipe.AddAttribute("Binome");
        equipe.classList.remove("drop");
    }

}

        const Barre_Def = document.querySelector(".Barre_Def")
        const Nav_Link = document.querySelector(".Nav_Link")

        Barre_Def.addEventListener('click', () =>{
        Nav_Link.classList.toggle('menu_mobile')
        })
