<!DOCTYPE html>
<html>
    <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <title>Lifevice</title>
    </head>

    <body>
        <div class="loader-container" id="loader-container">
            <div id="loader"></div>
        </div>
    <!-- Navigation -->
        <header>
            <nav>
                <div class="user"> </div>    
                <div class="logo">
                    <h1 >Lifevice</h1>
                </div>
                <div class="heart"> </div>
            </nav>
        </header>
    <!-- Map -->
        <main>
            <section class="container">
                <div class="box">
                    <div class="row" id="mapid">
                    </div>
                    <div class="map-actions">
                        <button class="btn" onclick="getMyLocation()">Find The Nearest Pharmacies</button>
                    </div>
                    <div class="row reset-map">
                        <a href="" class="link">reset map</a>
                    </div>
                </div>
            </section>
        </main>

    <!-- Footer -->
        <footer>
            <div class="container">
                <div class="information">
                    <p>&copy; 2020 Lifevice</p>
                    <a href="">Terms</a>
                    <a href="">Privacy</a>
                    <a href="">Security</a>
                    <a href="">FAQ's</a> 
                </div>
            </div>
        </footer>
    </body>


    <!-- Javascript Code-->
    <script>
        /*Variables*/
        var mts = "4000";
        var mymap = document.getElementById("mapid");
        var loader = document.getElementById("loader-container");
        const urlDenue = "https://www.inegi.org.mx/app/api/denue/v1/consulta/buscar/farmacias/";
        const token = "faee2e38-1c98-4b7a-b093-8255fbe33dd6";

        function getMyLocation(){
            if (navigator.geolocation){ 
                navigator.geolocation.getCurrentPosition(showMap);   
            }else{
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showMap(position){
            let url = `${urlDenue}${position.coords.latitude},${position.coords.longitude}/${mts}/${token}`;
            let array = getAnArrayOfThePharmaciesId();
            loader.style.display = "block";
            let response = getTheNearestPharmacies(url);
                response.then((value)=>{ 
                    if(value != "No hay resultados."){
                        drawMap(position);
                        for (let i = 0; i < value.length; i++){
                            showMatchedPharmacies(data[i].Latitud, data[i].Longitud, data[i].Nombre, data[i].Razon_social, data[i].Id, array);
                            //showAllMatchedPharmacies(data[i].Latitud, data[i].Longitud, data[i].Nombre, data[i].Razon_social, data[i].Id);
                        }
                        loader.style.display = "none";
                        showMyLocationOnTheMap(position.coords.latitude, position.coords.longitude);
                    }else{
                        document.getElementById("mapid").style.display="none";
                    }
                }).catch(function(error) {
                    loader.innerHTML="Ha ocurrido un error";
                    loader.style.display="block";
                });
        }

        function drawMap(position) {
            mymap = L.map('mapid').setView([position.coords.latitude,  position.coords.longitude], 12);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiZmVybmFuZG9kZWZleiIsImEiOiJja2puMWppOGMwcGhzMnFuMHpneXl0eHVkIn0.RqnHUax90sawRg1Wu05NSw'
            }).addTo(mymap);
        }

        function showMyLocationOnTheMap(latitude, longitude) {
            let marker = L.marker([latitude, longitude]).addTo(mymap);
            marker.bindPopup("<b>You are here</b>").openPopup();
            let circle = L.circle([latitude, longitude], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: mts
            }).addTo(mymap);
        }

        function showMatchedPharmacies(latitude, longitude, name, info, id, array){
            for (let j = 0; j < array.length; j++) {
                if(id==array[j]){
                    console.log(name + " "+ id + " = " +array[j]);
                    let marker = L.marker([latitude, longitude]).addTo(mymap);
                    marker.bindPopup(`<b>${name}</b> <br> ${info} <br> <a href="home/home.php?pharmacyId=${id}&pharmacyName=${name}">Visitar</a>`).openPopup();
                }
            }
        }

        function showAllMatchedPharmacies(latitude, longitude, name, info, id) {
            let marker = L.marker([latitude, longitude]).addTo(mymap);
            marker.bindPopup(`<b>${name}</b> <br> ${info} <br>`).openPopup();
        }

        async function getTheNearestPharmacies(path) {
            let myObject = await fetch(path);
            let myText = await myObject.text();
            data=JSON.parse(myText);
            return data;
        }

        async function getPharmaciesFromOurDatabase(path) {
            let myObject = await fetch(path);
            let myText = await myObject.text();
            data=JSON.parse(myText);
            return data;
        }

        function getAnArrayOfThePharmaciesId() {
            let res = getPharmaciesFromOurDatabase("../../../farmacias/index.php?pharmacies=all");
            let temp = Array();
            res.then((value) =>{
                for (let index = 0; index < value[0].length; index++) {
                    temp.push(value[0][index].pharmacyId);
                }
            }).catch((error) =>{
                console.log(error);
            });
            return temp;
        }

    </script>
</html>