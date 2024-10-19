<?php
include 'include/res_restrict_pages.php';
require_once 'include/header.php';
?>

<link rel="stylesheet" type="text/css" href="css/barangayMap.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<style>
    
</style>

<div class="content-holder">
    <div class="title-container pl-3">
        <h1>Barangay Map</h1>
        <hr class="bg-dark">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="map">
                    <div id="sidebar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var map = L.map('map', {
        zoomControl: false
    }).setView([10.319684884862491, 123.97180009156631], 15);

    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles © Esri — Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    }).addTo(map);

    L.control.zoom({
        position: 'bottomright'
    }).addTo(map);

    var pusokBoundary = L.polygon([
        [10.320232, 123.963036],
        [10.315600, 123.965917],
        [10.315181, 123.967606],
        [10.315666, 123.969446],
        [10.317171, 123.971256],
        [10.315711, 123.972120],
        [10.317358, 123.974545],
        [10.316341, 123.975704],
        [10.316348, 123.978757],
        [10.318356, 123.982317],
        [10.321195, 123.980450],
        [10.325231, 123.977362],
        [10.325508, 123.976080],
        [10.326069, 123.975852],
        [10.326088, 123.975485],
        [10.327261, 123.975487],
        [10.327748, 123.975464],
        [10.327162, 123.973773],
        [10.327152, 123.973735],
        [10.327051, 123.973527],
        [10.327187, 123.973446],
        [10.327125, 123.973313],
        [10.327036, 123.973371],
        [10.326884, 123.973259],
        [10.327008, 123.973072],
        [10.326966, 123.973004],
        [10.326771, 123.973086],
        [10.326528, 123.972926],
        [10.326665, 123.972830],
        [10.326606, 123.972744],
        [10.326468, 123.972855],
        [10.326446, 123.972556],
        [10.326379, 123.972220],
        [10.326349, 123.972031],
        [10.326502, 123.971917],
        [10.326427, 123.971732],
        [10.326336, 123.971703],
        [10.326301, 123.971648],
        [10.326345, 123.971621],
        [10.326295, 123.971547],
        [10.326227, 123.971595],
        [10.326203, 123.971542],
        [10.326025, 123.971167],
        [10.325872, 123.971205],
        [10.325824, 123.971069],
        [10.326067, 123.970941],
        [10.326000, 123.970705],
        [10.325756, 123.970747],
        [10.325726, 123.970482],
        [10.325903, 123.970535],
        [10.325990, 123.970257],
        [10.325871, 123.970184],
        [10.325943, 123.969958],
        [10.325945, 123.969714],
        [10.325837, 123.969371],
        [10.325773, 123.969118],
        [10.325589, 123.968809],
        [10.325548, 123.968731],
        [10.325353, 123.968488],
        [10.325181, 123.968230],
        [10.325206, 123.967843],
        [10.325188, 123.967800],
        [10.325175, 123.967764],
        [10.325133, 123.967703],
        [10.325177, 123.967675],
        [10.324948, 123.967349],
        [10.324729, 123.967259],
        [10.324308, 123.967410],
        [10.321969, 123.965447], //SITIO1
        [10.321670, 123.965792],
        [10.321432, 123.965447],
        [10.321902, 123.965162],
        [10.321868, 123.964954],
        [10.321999, 123.964825],
        [10.321827, 123.964627],
        [10.321756, 123.964673],
        [10.321480, 123.964221],
        [10.321447, 123.964172],
        [10.321372, 123.964070],
        [10.321238, 123.964134],
        [10.321152, 123.963971],
        [10.321223, 123.963816],
        [10.321152, 123.963376],
        [10.320838, 123.963243],
        [10.320726, 123.963288],
        [10.320644, 123.963303],
        [10.320566, 123.963224],
        [10.320461, 123.963239],
        [10.320342, 123.963300]
    ], {
        color: 'red',
        weight: 7,
        fillColor: 'transparent',
        dashArray: '10, 10'
    }).addTo(map);
    pusokBoundary.bindPopup("Barangay Pusok");

    var purok1Boundary = L.polygon([

        [10.318435, 123.964144],
        [10.320471, 123.966813],
        [10.321068, 123.966264],
        [10.321582, 123.965643],
        [10.321432, 123.965447],
        [10.321902, 123.965162],
        [10.321868, 123.964954],
        [10.321999, 123.964825],
        [10.321827, 123.964627],
        [10.321756, 123.964673],
        [10.321480, 123.964221],
        [10.321447, 123.964172],
        [10.321372, 123.964070],
        [10.321238, 123.964134],
        [10.321152, 123.963971],
        [10.321223, 123.963816],
        [10.321152, 123.963376],
        [10.320838, 123.963243],
        [10.320726, 123.963288],
        [10.320644, 123.963303],
        [10.320566, 123.963224],
        [10.320461, 123.963239],
        [10.320342, 123.963300],
        [10.320232, 123.963036],

    ], {
        color: 'Blue',
        weight: 3,
        fillColor: 'rgba(0, 0, 255, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok1Boundary.bindPopup("Lower Mustang")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Lower Mustang</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });

    var purok2Boundary = L.polygon([
        [10.320471, 123.966813],
        [10.321967, 123.969074],
        [10.322236, 123.969709],
        [10.324345, 123.968331],
        [10.324544, 123.968373],
        [10.324743, 123.968241],
        [10.324777, 123.968225],
        [10.324855, 123.968293],
        [10.324952, 123.968359],
        [10.325181, 123.968230],
        [10.325206, 123.967843],
        [10.325188, 123.967800],
        [10.325175, 123.967764],
        [10.325133, 123.967703],
        [10.325177, 123.967675],
        [10.324948, 123.967349],
        [10.324729, 123.967259],
        [10.324308, 123.967410],
        [10.321969, 123.965447],
        [10.321670, 123.965792],
        [10.321582, 123.965643],
    ], {
        color: 'rgba(255, 255, 0, 1)', //yellow
        weight: 3,
        fillColor: 'rgba(255, 255, 5, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok2Boundary.bindPopup("Seaside")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Seaside</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });

    var purok3Boundary = L.polygon([
        [10.323353, 123.969040],
        [10.324345, 123.968331],
        [10.324544, 123.968373],
        [10.324743, 123.968241],
        [10.324777, 123.968225],
        [10.324855, 123.968293],
        [10.324952, 123.968359],
        [10.325181, 123.968230],
        [10.325353, 123.968488],
        [10.325548, 123.968731],
        [10.325589, 123.968809],
        [10.325773, 123.969118],
        [10.325837, 123.969371],
        [10.325945, 123.969714],
        [10.325943, 123.969958],
        [10.325871, 123.970184],
        [10.325990, 123.970257],
        [10.325903, 123.970535],
        [10.325726, 123.970482],
        [10.325756, 123.970747],
        [10.326000, 123.970705],
        [10.326067, 123.970941],
        [10.325824, 123.971069],
        [10.325872, 123.971205],
        [10.326025, 123.971167],
        [10.326203, 123.971542],
        [10.326227, 123.971595],
        [10.326295, 123.971547],
        [10.326024, 123.971996],


    ], {
        color: 'rgba(0, 255, 0, 1)', //green
        weight: 3,
        fillColor: 'rgba(0, 255, 5, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok3Boundary.bindPopup("San Roque")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">San Roque</h5>
                    <div style="padding: 10px; ">
                        <p>Address: [Insert Address]</p>
                        <p>Contact: [Insert Contact]</p>
                        <p>Office Hours: [Insert Office Hours]</p>
                        <p>Services: [List of Services]</p>
                    </div>`;
            toggleSidebar(content);
        });

    var purok4Boundary = L.polygon([
        [10.324324, 123.973897],
        [10.325664, 123.972530],
        [10.326295, 123.971547],
        [10.326427, 123.971732],
        [10.326502, 123.971917],
        [10.326349, 123.972031],
        [10.326379, 123.972220],
        [10.326446, 123.972556],
        [10.326468, 123.972855],
        [10.326606, 123.972744],
        [10.326665, 123.972830],
        [10.326528, 123.972926],
        [10.326771, 123.973086],
        [10.326966, 123.973004],
        [10.327008, 123.973072],
        [10.326884, 123.973259],
        [10.327036, 123.973371],
        [10.327125, 123.973313],
        [10.327187, 123.973446],
        [10.327051, 123.973527],
        [10.327152, 123.973735],
        [10.327162, 123.973773],
        [10.327748, 123.975464],
        [10.327261, 123.975487],
        [10.326088, 123.975485],
        [10.326069, 123.975852],
        [10.325508, 123.976080],
        [10.324324, 123.973897] // Closing the polygon

    ], {
        color: 'rgba(255, 0, 255, 1)', //magenta
        weight: 3,
        fillColor: 'rgba(255, 0, 255, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok4Boundary.bindPopup("Sta. Maria")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Sta. Maria</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });


    var purok5Boundary = L.polygon([
        [10.315600, 123.965917],
        [10.317174, 123.967798],
        [10.320107, 123.966473],
        [10.318435, 123.964144],
    ], {
        color: 'rgba(255, 165, 0, 1)', //orange
        weight: 3,
        fillColor: 'rgba(255, 0, 0, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok5Boundary.bindPopup("Upper Mustang") //mustang
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Upper Mustang</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });


    var purok6Boundary = L.polygon([
        [10.315600, 123.965917],
        [10.315181, 123.967606],
        [10.315666, 123.969446],
        [10.317171, 123.971256],
        [10.318304, 123.971195],
        [10.319411, 123.970603],
        [10.317174, 123.967798],


    ], {
        color: 'rgba(135, 206, 235, 1)', //skyblue
        weight: 3,
        fillColor: 'rgba(0, 0, 255, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok6Boundary.bindPopup("Seawage") //sewage
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Seawage</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });

    var purok7Boundary = L.polygon([

        [10.319411, 123.970603],
        [10.317174, 123.967798],
        [10.320107, 123.966473],
        [10.321320, 123.968052],
        [10.319955, 123.969670],
        [10.319702, 123.969852],
        [10.319834, 123.970163],


    ], {
        color: 'rgba(0, 0, 0, 1)', //black
        weight: 3,
        fillColor: 'rgba(0, 0, 0, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok7Boundary.bindPopup("Cemento") //cemento
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Cemento</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });

    var purok8Boundary = L.polygon([
        [10.323263, 123.971809],
        [10.321967, 123.969074],
        [10.321320, 123.968052],
        [10.319955, 123.969670],
        // [10.319702, 123.969852],
        //[10.319834, 123.970163], 
        // [10.319411, 123.970603],
        // [10.320621, 123.972779],
        // [10.321229, 123.972659],
        [10.321858, 123.972241],
        [10.322390, 123.972330]
    ], {
        color: 'rgba(255, 192, 203, 1)', //pink
        weight: 3,
        fillColor: 'rgba(255, 192, 203, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok8Boundary.bindPopup("Ibabao") //ibabao
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e) // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Ibabao</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });
    var purok9Boundary = L.polygon([

        // [10.320621, 123.972779],
        // [10.319411, 123.970603],   
        [10.318304, 123.971195],
        [10.317171, 123.971256],
        [10.315711, 123.972120],
        [10.317358, 123.974545],
        [10.319595, 123.976400],
        [10.320188, 123.974177],
        // [10.320398, 123.973266],
        // [10.320627, 123.973203],
        // [10.320529, 123.972855],

    ], {
        color: 'rgba(189, 252, 201, 1)', //mint
        weight: 3,
        fillColor: 'rgba(189, 252, 201, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok9Boundary.bindPopup("Lower Matumbo")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Lower Matumbo</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });

    var purok10Boundary = L.polygon([
        [10.319595, 123.976400],
        [10.320188, 123.974177],
        [10.320398, 123.973266],
        [10.320627, 123.973203],
        [10.320529, 123.972855],
        [10.320621, 123.972779],
        [10.321229, 123.972659],
        [10.321858, 123.972241],
        [10.322390, 123.972330],
        [10.323263, 123.971809],
        [10.324324, 123.973897], //corner
        [10.322760, 123.975487],
        [10.321606, 123.976245],
    ], {
        color: 'rgba(245, 245, 220, 1)', //beige
        weight: 3,
        fillColor: 'rgba(245, 245, 220, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok10Boundary.bindPopup("Lawis")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Lawis</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });


    var purok11Boundary = L.polygon([
        [10.323353, 123.969040],
        [10.322285, 123.969685],
        [10.324324, 123.973897],
        [10.325664, 123.972530],
        [10.326047, 123.971997]
    ], {
        color: 'rgba(199, 21, 133, 1)', //red violet
        weight: 3,
        fillColor: 'rgba(199, 21, 133, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok11Boundary.bindPopup("Seabreeze")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Seabreeze1</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });

    var purok12Boundary = L.polygon([
        [10.316341, 123.975704],
        [10.317358, 123.974545],
        [10.319595, 123.976400],
        [10.321195, 123.980450],
        [10.318356, 123.982317],
        [10.316348, 123.978757]

    ], {
        color: 'rgba(139, 0, 0, 1)', //dark red
        weight: 3,
        fillColor: 'rgba(199, 21, 133, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok12Boundary.bindPopup("ARCA")
    // purok12Boundary.bindTooltip("ARCA", {
    //         permanent: false,
    //         direction: 'top'
    //     })
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">ARCA</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });

    var purok13Boundary = L.polygon([
        [10.319955, 123.969670],
        [10.319702, 123.969852],
        [10.319834, 123.970163],
        [10.319411, 123.970603],
        [10.318304, 123.971195],
        [10.320184, 123.974193],
        [10.320398, 123.973266],
        [10.320627, 123.973203],
        [10.320529, 123.972855],
        [10.320621, 123.972779],
        [10.321229, 123.972659],
        [10.321858, 123.972241],
    ], {
        color: 'rgba(64, 64, 64, 1)', //dark gray
        weight: 3,
        fillColor: 'rgba(199, 21, 133, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok13Boundary.bindPopup("Upper Matumbo")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Upper Matumbo</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });

    var purok14Boundary = L.polygon([

        [10.324324, 123.973897],
        [10.322760, 123.975487],
        [10.321606, 123.976245],
        [10.319595, 123.976400],
        [10.321195, 123.980450],
        [10.325231, 123.977362],
        [10.325508, 123.976080],

    ], {
        color: 'rgba(0, 100, 0, 1)', //dark green
        weight: 3,
        fillColor: 'rgba(0, 255, 5, 0.5)',
        fillOpacity: 0.5
    }).addTo(map);
    purok14Boundary.bindPopup("New-Lipata")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">New-Lipata</h5>
                        <div style="padding: 10px; ">
                            <p>Address: [Insert Address]</p>
                            <p>Contact: [Insert Contact]</p>
                            <p>Office Hours: [Insert Office Hours]</p>
                            <p>Services: [List of Services]</p>
                        </div>`;
            toggleSidebar(content);
        });


//barangay hall landmark
L.marker([10.324497082318432, 123.97433802067657], {
        icon: L.icon({
            iconUrl: 'PicturesNeeded/townHall.png',
            iconSize: [18, 18],
            iconAnchor: [16, 25],
            popupAnchor: [0, -32]
        })
    })
    .addTo(map)
    .bindPopup('Pusok Barangay Hall')
    .on('click', function(e) {
        L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
        var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Pusok Barangay Hall</h5>
                    <div style="padding: 10px; ">
                        <p>Address: [Insert Address]</p>
                        <p>Contact: [Insert Contact]</p>
                        <p>Office Hours: [Insert Office Hours]</p>
                        <p>Services: [List of Services]</p>
                    </div>`;
        toggleSidebar(content);
    });



    // Set the maximum bounds to the pusokBoundary
    var bounds = pusokBoundary.getBounds();
    map.setMaxBounds(bounds);
    map.options.minZoom = map.getBoundsZoom(bounds);

    function toggleSidebar(content) {
        var sidebar = document.getElementById('sidebar');
        sidebar.innerHTML = content;
        sidebar.classList.add('active');
    }

    // Function to hide sidebar
    function hideSidebar() {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.remove('active');
    }

    // Add click event listener to the map
    map.on('click', function(e) {
        // Check if the click is outside all polygons
        var isOutsidePolygons = true;
        map.eachLayer(function(layer) {
            if (layer instanceof L.Polygon && layer.getBounds().contains(e.latlng)) {
                isOutsidePolygons = false;
            }
        });

        if (isOutsidePolygons) {
            hideSidebar();
        }
    });
</script>

<?php include 'include/footer.php' ?>