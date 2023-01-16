window.addEventListener("load", function(){

    /**
     * call this function throw AJAX fetch 
     * 
     * @param {Json array} itemsJson
     */
    function success(itemsJson){

        let itemList = document.getElementById("items"); // get the element

        itemList.innerHTML = ""; // clear the div 

        for (let i = 0; i < itemsJson.length; i++) {
            // create tt element
            var tr = document.createElement('tr');

            // create checkbox and get its state depent on cheched data record in table
            var inputCheckbox = document.createElement("input");
            inputCheckbox.type = "checkbox";
            if(itemsJson[i].checked == 1){
                inputCheckbox.checked = true;
            }
            else{
                inputCheckbox.checked = false;
            }
            // create td element
            var tdChecked = document.createElement('td');
            tdChecked.appendChild(inputCheckbox);   // add inputCheckbox to this td       
            tdChecked.onclick = function(){             // Attach the event!
                let url = "updateitem.php?id=" + itemsJson[i].id;
                fetch(url, {credentials: 'include'})    //fetch updateitem.php
                    .then(response => response.json())
                    .then(success);
            }; 

            // create td element
            var tdDelete = document.createElement('td');
            tdDelete.className = "delete"; // Class name, to implement style
            tdDelete.innerHTML = 'X'; // Text inside means delete
            tdDelete.onclick = function(){      // Attach the event
                let url = "deleteitem.php?id=" + itemsJson[i].id;
                fetch(url, {credentials: 'include'})        //fetch deleteitem.php
                    .then(response => response.json())
                    .then(success);
            };

            // create td element.
            var tdItem = document.createElement("td");
            tdItem.innerHTML = itemsJson[i].item + "(" + itemsJson[i].quantity + ")"; // add item and quantity

            // add tds to tr element
            tr.appendChild(tdChecked);
            tr.appendChild(tdDelete);
            tr.appendChild(tdItem);

             // add tr to itemList element
            itemList.appendChild(tr);

        }

    }

    

    // items.php do get data from table: SELECT
    // make fetch when load the website 
    fetch("loaddata.php", {credentials: 'include'})
        .then(response => response.json())
        .then(success);


    // get submit button element
    let button = this.document.forms.form.addEventListener("submit", function(event){
        event.preventDefault(); // prevent reload the website
            // get the item name
        let item = document.forms.form.item.value;
            // get the quantity of the item
        let quantity = document.forms.form.quantity.value;
            // constract the URL with @item and @quantity parameters
            // add.php do add new item to the table: INSERT
        url = "additem.php?item=" + item + "&quantity=" + quantity;

        // return back defaulte value for boxes
        document.forms.form.item.value = "";      
        document.forms.form.quantity.value = 1;

            // make the fetch
        fetch(url, {credentials: 'include'})
            .then(response => response.json())
            .then(success);
    });

});
