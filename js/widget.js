/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/

"use strict";

// Skapa variabler och instans av XMLHttpRequest object
var xhr = new XMLHttpRequest();
var widget = document.getElementById("widget");
var i;

// Funktion som tar emot och hanterar JSON-fil
xhr.onload = function() {

    // Kontrollerar serverstatus
    if (xhr.status === 200) {

        // Variabel med info från JSON-fil
        var json = JSON.parse(xhr.responseText);

        // Hämtar data från JSON-fil och skriver ut
        for (i=0; i<5; i++) {
            
            // Skapar en div med underliggande p-element som innehållder data från JSON-filen
            var widgetDate = document.createElement("p");
            var txtForWidgetDate = document.createTextNode(json[i].creationdate);
            widgetDate.setAttribute("class", "blogDate");
            widgetDate.appendChild(txtForWidgetDate);

            var widgetHeader = document.createElement("h4");
            var txtForWidgetHeader = document.createTextNode(json[i].header);
            widgetHeader.setAttribute("class", "blogHead");
            widgetHeader.appendChild(txtForWidgetHeader);
            
            var widgetPost = document.createElement("p");
            var txtForWidgetPost = document.createTextNode(json[i].post_text);
            widgetPost.setAttribute("class", "blogText");
            widgetPost.appendChild(txtForWidgetPost);

            var widgetUserP = document.createElement("p");
            var txtForWidgetUSerP = document.createTextNode("Skrivet av: ");
            widgetUserP.setAttribute("class", "writtenBy");
            widgetUserP.appendChild(txtForWidgetUSerP);

            var widgetUser = document.createElement("a");
            var txtForWidgetUser = document.createTextNode(json[i].username);
            widgetUser.setAttribute("href", "user.php?user=" + json[i].username);
            widgetUser.setAttribute("class", "blogUser");
            widgetUser.appendChild(txtForWidgetUser);
            
            var widgetDiv = document.createElement("div");
            widgetDiv.setAttribute("class", "blogPost");
            widgetDiv.appendChild(widgetDate);
            widgetDiv.appendChild(widgetHeader);
            widgetDiv.appendChild(widgetPost);
            widgetDiv.appendChild(widgetUserP);
            widgetDiv.appendChild(widgetUser);

            widget.appendChild(widgetDiv);

        }

    }
    // Skriver ut eventuellt felmeddelande
    else {
        console.log(xhr.status);
    }

};

// Anropar server och berättar vilken fil som ska hämtas
xhr.open('GET', 'http://studenter.miun.se/~joli0939/dt093g/projekt/rest.php?numrows=5', true);

// Gör anrop till server
xhr.send(null);