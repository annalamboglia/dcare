<script type="text/javascript">
    /* Numero di persone per pagina */
    var people_for_page = 10;

    /* Invocazione della funzione su id_table ogni volta che viene settata una pagina 
       per mostrare solo le persone nella pagina corrente
    */
    function setTable(id_table, page) {

        /* Deve essere definito table-elements PDOStatement */
        var number_people = this.visible_elements.length;

        /* Numero di pagine della tabella arrotondato per eccesso */
        var number_page = Math.ceil(number_people / people_for_page);

        /* Display degli elementi della pagine corrente */

        let left = people_for_page * (page - 1);
        let right = people_for_page * page;


        for (let i = 0; i < this.visible_elements.length; i++) {

            /* Persone da nascondere */
            if (i < left) {
                visible_elements[i].style.display = "none";
            }

            /* Elementi da far rimanere visibili */
            else if (i >= left && i < right) {
                visible_elements[i].style.display = "";
            }

            /* Elementi da nascondere */
            else if (i >= right) {
                visible_elements[i].style.display = "none";
            }

        }

        /* Set dei bottoni nel footer della tabella */
        setButtonPage(id_table, page);
    }
    /* ------------------------- */


    /* Funzione per il settaggio dei bottoni pagine in footer */
    function setButtonPage(id_table, page) {

        /* Deve essere definito table-elements PDOStatement */
        var number_people = this.visible_elements.length;

        /* Numero di pagine della tabella arrotondato per eccesso */
        var number_page = Math.ceil(number_people / people_for_page);

        let firstButton = document.getElementById("firstPageButton");
        let secondButton = document.getElementById("secondPageButton");
        let thirdButton = document.getElementById("thirdPageButton");

        let previousButton = document.getElementById("previousButton");
        let nextButton = document.getElementById("nextButton");



        /* Visibilità dei bottoni necessari in base al numero di pagine */
        if (number_page <= 1) {

            firstButton.style.display = "";
            firstButton.classList.add("active");
            firstButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + 1 + ")");
            firstButton.getElementsByTagName("a")[0].innerHTML = 1;

            secondButton.style.display = "none";
            thirdButton.style.display = "none";

            previousButton.setAttribute("onclick", "");
            nextButton.setAttribute("onclick", "");

        } else if (number_page == 2) {

            firstButton.style.display = "";
            secondButton.style.display = "";
            thirdButton.style.display = "none";
            nextButton.setAttribute("onclick", "setTable('dataTable',2)");

            firstButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + 1 + ")");
            firstButton.getElementsByTagName("a")[0].innerHTML = 1;

            secondButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + 2 + ")");
            secondButton.getElementsByTagName("a")[0].innerHTML = 2;

            if (page == 1) {

                firstButton.classList.add("active");
                secondButton.classList.remove("active");


            } else {

                firstButton.classList.remove("active");
                secondButton.classList.add("active");

            }


        } else if (number_page > 2) {

            firstButton.style.display = "";
            secondButton.style.display = "";
            thirdButton.style.display = "";


            /* Se ci si trova nella prima pagina */
            if (page == 1) {


                firstButton.classList.add("active");
                secondButton.classList.remove("active");
                thirdButton.classList.remove("active");

                firstButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + page + ")");
                firstButton.getElementsByTagName("a")[0].innerHTML = page;

                secondButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + (page + 1) + ")");
                secondButton.getElementsByTagName("a")[0].innerHTML = page + 1;

                thirdButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + (page + 2) + ")");
                thirdButton.getElementsByTagName("a")[0].innerHTML = page + 2;

                previousButton.setAttribute("onclick", "setTable('dataTable',1)");
                nextButton.setAttribute("onclick", "setTable('dataTable',2)");

                /* Se ci si trova nell'ultima pagina */
            } else if (page == number_page) {


                firstButton.classList.remove("active");
                secondButton.classList.remove("active");
                thirdButton.classList.add("active");

                firstButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + (page - 2) + ")");
                firstButton.getElementsByTagName("a")[0].innerHTML = page - 2;

                secondButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + (page - 1) + ")");
                secondButton.getElementsByTagName("a")[0].innerHTML = page - 1;

                thirdButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + page + ")");
                thirdButton.getElementsByTagName("a")[0].innerHTML = page;

                previousButton.setAttribute("onclick", "setTable('dataTable'," + (page - 1 ) + ")");
                nextButton.setAttribute("onclick", "setTable('dataTable'," + page + ")");

            } else {


                firstButton.classList.remove("active");
                secondButton.classList.add("active");
                thirdButton.classList.remove("active");

                firstButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + (page - 1) + ")");
                firstButton.getElementsByTagName("a")[0].innerHTML = page - 1;

                secondButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + page + ")");
                secondButton.getElementsByTagName("a")[0].innerHTML = page;

                thirdButton.getElementsByTagName("a")[0].setAttribute("onclick", "setTable('dataTable'," + (page + 1) + ")");
                thirdButton.getElementsByTagName("a")[0].innerHTML = page + 1;

                previousButton.setAttribute("onclick", "setTable('dataTable'," + (page - 1 ) + ")");
                nextButton.setAttribute("onclick", "setTable('dataTable'," + (page + 1) + ")");

            }

        }

    }

    setTable("dataTable", 1);
</script>