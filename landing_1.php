
   <h3 class="tabtitle" id ="stresshiddendiv">Stress </h3>


<body onload="getgraph()">
<style>
/* Set height of body and the document to 100% to enable "full page tabs" */
body, html {
  /*height: 100%;*/
  margin: 0;
  font-family: Arial;
}


</style>
<script>
function openPage(pageName, elmnt, color) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = color;
  
}

</script>

<script>
   function deletegraph($input)
   {
      document.getElementById('stressgraph').remove();
   };
</script>
<script>

   function getgraph()
   
   {
   
   //new xmlhttprequest object
   var xmlhttp = new XMLHttpRequest();
   //function to execute on response
   xmlhttp.onreadystatechange = function() 
   {
      if (this.readyState == 4 && this.status == 200) 
      {


//    var svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
//    var svgNS = svg.namespaceURI;
//
//    var rect = document.createElementNS(svgNS,'rect');
//    rect.setAttribute(this.ResponseText);
//    svg.appendChild(rect);
//    var el = document.getElementById("Stress");
//    el.appendChild(svg);
    document.querySelector('#stresshiddendiv').insertAdjacentHTML('afterend', this.responseText);

    console.log(screen.width);
    console.log(screen.height);
      }
   };

      
      
   //goes to src/update/basekt/addnewtobasket.php
   //alert("added" + $id);
   //xmlhttp.open("GET","../web/returngraph_1.php?p="+screen.width+"&q="+screen.height , true);
   //xmlhttp.open("GET","../web/returngraph_1.php?p="+980+"&q="+1040 , true);
   xmlhttp.open("GET","../web/returngraph_1.php?p="+screen.width+"&q="+screen.height , true);
   xmlhttp.send();
   
   };
</script>
<style>
body {
  font-family: 'Montserrat', roboto;
}

.graph .labels.x-labels {
  text-anchor: middle;
}

.graph .labels.y-labels {
  text-anchor: end;
}


.graph {
 animation: hideshow 1.5s ease-in;
 height: 100%;
 width: 100%;
 position: absolute;
}

.graph .grid {
  stroke: #ccc;
  stroke-dasharray: 0;
  stroke-width: 1;


}

.labels {
  font-size: 13px;
}

.label-title {
  font-weight: bold;
  text-transform: uppercase;
  font-size: 12px;
  fill: black;
}

.data {
  fill: black;
  stroke-width: 1; 
}

.circle
{
   fill: #330052;
  height: 21px;
  transition: fill .3s ease;
  cursor: pointer;
  font-family: Montserrat, roboto;
  animation: hideshow 4s ease-in;
}

.circle:hover,
.circle:focus 
.circle:active{
  
  fill: #f2000d;
}

.path {
  stroke-dasharray: 6000;
  stroke-dashoffset: 6000;
  animation: dash 6s linear forwards;
}

@keyframes dash {
  from {
    stroke-dashoffset: 6000;
  }
  to {
    stroke-dashoffset: 0;
  }
  
}


@keyframes hideshow {
  0% { opacity: 0.1; }
  20% { opacity: 0.2; }
  40% { opacity: 0.4; }
  60% { opacity: 0.6; }
  80% { opacity: 0.8; }
  100% {opacity: 1.0;}
} 

</style>

<style>
body {font-family: Montserrat; }
p{ color:#202020;}
.tabtitle {
   margin-left: 10%;
   padding: 10px;
   margin-bottom: 0;
   font-size: 60px;
  color: #202020;
  /*animation: hideshow 2s ease-in;*/

}


h3
{
   color: #202020;
}

/* Style the close button */
.topright {
  float: right;
  cursor: pointer;
  font-size: 28px;
}

.topright:hover {color: red;}

.graphtabcontent
{
   display: block;
   margin-bottom: 10px;
   margin-left: 5%;
   animation: hideshow .3s ease-in;

}
.rectbar
{
   fill: #330052;
  transition: fill .3s ease;
  cursor: pointer;
  font-family: Montserrat, roboto;
  animation: hideshow 4s ease-in;
}

.rectbar:hover,
.rectbar:focus 
.rectbar:active{
  
  fill: #f2000d;
}
</style>

<script>
function openPoint(evt, pointName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("graphtabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  document.getElementById(pointName).style.display = "block";
  evt.currentTarget.className += " active";
}

</script>