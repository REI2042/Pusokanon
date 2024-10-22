<?php
include 'include/res_restrict_pages.php';
require_once 'include/header.php';
require_once 'db/DBconn.php';

$sitioData = fetchSitioData($pdo);
?>

<link rel="stylesheet" type="text/css" href="css/barangayMap.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<div class="content-holder">
    <div class="title-container pl-3 pr-3">
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
    var sitioData = <?php echo json_encode($sitioData); ?>;

    function getSitioData(sitioName) {
        return sitioData.find(sitio => sitio.sitio_name === sitioName) || {};
    }
    
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
            var data = getSitioData('Mustang');
            var content = `<h5 style="background-color: #0000FF; color: white; padding:10px;">Lower Mustang</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
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
    purok2Boundary.bindPopup("Seabreeze")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var data = getSitioData('Seabreeze');
            var content = `<h5 style="background-color: #FFFF05; color: black; padding:10px;">Seabreeze</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
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
            var data = getSitioData('San Roque');
            var content = `<h5 style="background-color: #00FF05; color: black; padding:10px;">San Roque</h5>
                    <div style="padding: 10px; ">
                        <p>Initial Population: ${data.total_initial_residents}</p>
                        <p>Registered Residents: ${data.registered_residents}</p>
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
            var data = getSitioData('Sta. Maria');
            var content = `<h5 style="background-color: #FF00FF; color: white; padding:10px;">Sta. Maria</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
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
            var data = getSitioData('Mustang');
            var content = `<h5 style="background-color: #FF0000; color: white; padding:10px;">Upper Mustang</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
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
            var data = getSitioData('Seawage');
            var content = `<h5 style="background-color: #87CEEB; color: white; padding:10px;">Seawage</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
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
            var data = getSitioData('Cemento');
            var content = `<h5 style="background-color: #000000; color: white; padding:10px;">Cemento</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
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
            var data = getSitioData('Ibabao');
            var content = `<h5 style="background-color: #FFC0CB; color: white; padding:10px;">Ibabao</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
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
            var data = getSitioData('Matumbo');
            var content = `<h5 style="background-color: #BDFCC9; color: black; padding:10px;">Lower Matumbo</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
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
            var data = getSitioData('Lawis');
            var content = `<h5 style="background-color: #F5F5DC; color: black; padding:10px;">Lawis</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
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
    purok11Boundary.bindPopup("Seaside")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var data = getSitioData('Seaside');
            var content = `<h5 style="background-color: #C71585; color: white; padding:10px;">Seaside</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
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
        var data = getSitioData('Arca');
        var content = `<h5 style="background-color: #C71585; color: white; padding:10px;">ARCA</h5>
                    <div style="padding: 10px; ">
                        <p>Initial Population: ${data.total_initial_residents}</p>
                        <p>Registered Residents: ${data.registered_residents}</p>
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
            var data = getSitioData('Matumbo');
            var content = `<h5 style="background-color: #404040; color: white; padding:10px;">Upper Matumbo</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
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
    purok14Boundary.bindPopup("Lipata")
        .on('click', function(e) {
            L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
            var data = getSitioData('Lipata');
            var content = `<h5 style="background-color: #006400; color: white; padding:10px;">Lipata</h5>
                        <div style="padding: 10px; ">
                            <p>Initial Population: ${data.total_initial_residents}</p>
                            <p>Registered Residents: ${data.registered_residents}</p>
                        </div>`;
            toggleSidebar(content);
        });


    //barangay hall landmark
    L.marker([10.324497082318432, 123.97433802067657], {
        icon: L.divIcon({
            className: 'custom-div-icon', // Add custom styles if needed
            html: '<i class="fas fa-landmark  fa-2x" style="color: #FFFDD0;"></i>', // Font Awesome icon
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
                    <div style="padding: 10px;">
                        <p>Address: Quezon National Hwy, Lapu-Lapu City, Cebu</p>
                        <p>Office Hours: 7 am to 4 pm </p>
                        <p>Services: Request Documents, File Complaints, and etc.</p>
                    </div>`;
        toggleSidebar(content);
    });


    //flood zone
    L.marker([10.317246, 123.969719], {
        icon: L.divIcon({
            className: 'custom-div-icon', // Add custom styles if needed
            html: '<i class="fa-solid fa-house-flood-water fa-2x" style="color: #1E90FF;"></i>', // Font Awesome icon
            iconSize: [18, 18],
            iconAnchor: [16, 25],
            popupAnchor: [0, -32]
        })
    })
    .addTo(map)
    .bindPopup('Flood Prone Area')
    .on('click', function(e) {
        L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
        var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Flood Prone Area</h5>
                    <div style="padding: 10px;">
                        Can reach up to knee level during typoons.
                    </div>`;
        toggleSidebar(content);
    });

    //flood zone
    L.marker([10.320211, 123.974240], {
        icon: L.divIcon({
            className: 'custom-div-icon', // Add custom styles if needed
            html: '<i class="fa-solid fa-house-flood-water fa-2x" style="color: #1E90FF;"></i>', // Font Awesome icon
            iconSize: [18, 18],
            iconAnchor: [16, 25],
            popupAnchor: [0, -32]
        })
    })
    .addTo(map)
    .bindPopup('Flood Prone Area')
    .on('click', function(e) {
        L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
        var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Flood Prone Area</h5>
                    <div style="padding: 10px;">
                        Can reach up to knee level during typoons.
                    </div>`;
        toggleSidebar(content);
    });

    //evacution site
    L.marker([10.318637, 123.972070], {
        icon: L.divIcon({
            className: 'custom-div-icon', // Add custom styles if needed
            html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="28" height="25"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path stroke="#fff" stroke-width="20" fill="#228B22" d="M396.6 6.5L235.8 129.1c9.6 1.8 18.9 5.8 27 12l168 128c13.2 10.1 22 24.9 24.5 41.4l6.2 41.5L608 352c9.3 0 18.2-4.1 24.2-11.1s8.8-16.4 7.4-25.6l-24-160c-1.2-8.2-5.6-15.7-12.3-20.7l-168-128c-11.5-8.7-27.3-8.7-38.8 0zm-153.2 160c-11.5-8.7-27.3-8.7-38.8 0l-168 128c-6.6 5-11 12.5-12.3 20.7l-24 160c-1.4 9.2 1.3 18.6 7.4 25.6S22.7 512 32 512l144 0 16 0c17.7 0 32-14.3 32-32l0-118.1c0-5.5 4.4-9.9 9.9-9.9c3.7 0 7.2 2.1 8.8 5.5l68.4 136.8c5.4 10.8 16.5 17.7 28.6 17.7l60.2 0 16 0c9.3 0 18.2-4.1 24.2-11.1s8.8-16.4 7.4-25.6l-24-160c-1.2-8.2-5.6-15.7-12.3-20.7l-168-128z"/></svg>', // Font Awesome icon
            iconSize: [18, 18],
            iconAnchor: [16, 25],
            popupAnchor: [0, -32]
        })
    })
    .addTo(map)
    .bindPopup('Evaction Site')
    .on('click', function(e) {
        L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
        var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Evacuation Site</h5>
                    <div style="padding: 10px;">
                        Safe zone for evacuation during typhoons.
                        <img src="PicturesNeeded/EvacuationSite4.png" alt="Evacuation Site" style="max-width: 100%; height: auto; margin-top: 10px;">
                        <img src="PicturesNeeded/EvacuationSite5.png" alt="Evacuation Site" style="max-width: 100%; height: auto; margin-top: 10px;">
                    </div>`;
        toggleSidebar(content);
    });
    L.marker([10.319229141609858, 123.9689232160307], {
        icon: L.divIcon({
            className: 'custom-div-icon', // Add custom styles if needed
            html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="28" height="25"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path stroke="#fff" stroke-width="20" fill="#228B22" d="M396.6 6.5L235.8 129.1c9.6 1.8 18.9 5.8 27 12l168 128c13.2 10.1 22 24.9 24.5 41.4l6.2 41.5L608 352c9.3 0 18.2-4.1 24.2-11.1s8.8-16.4 7.4-25.6l-24-160c-1.2-8.2-5.6-15.7-12.3-20.7l-168-128c-11.5-8.7-27.3-8.7-38.8 0zm-153.2 160c-11.5-8.7-27.3-8.7-38.8 0l-168 128c-6.6 5-11 12.5-12.3 20.7l-24 160c-1.4 9.2 1.3 18.6 7.4 25.6S22.7 512 32 512l144 0 16 0c17.7 0 32-14.3 32-32l0-118.1c0-5.5 4.4-9.9 9.9-9.9c3.7 0 7.2 2.1 8.8 5.5l68.4 136.8c5.4 10.8 16.5 17.7 28.6 17.7l60.2 0 16 0c9.3 0 18.2-4.1 24.2-11.1s8.8-16.4 7.4-25.6l-24-160c-1.2-8.2-5.6-15.7-12.3-20.7l-168-128z"/></svg>', // Font Awesome icon
            iconSize: [18, 18],
            iconAnchor: [16, 25],
            popupAnchor: [0, -32]
        })
    })
    .addTo(map)
    .bindPopup('Evaction Site')
    .on('click', function(e) {
        L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
        var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Evacuation Site</h5>
                    <div style="padding: 10px;">
                        Safe zone for evacuation during typhoons.
                        <img src="PicturesNeeded/EvacuationSite1.png" alt="Evacuation Site" style="max-width: 100%; height: auto; margin-top: 10px;">
                        <img src="PicturesNeeded/EvacuationSite2.png" alt="Evacuation Site" style="max-width: 100%; height: auto; margin-top: 10px;">
                    </div>`;
        toggleSidebar(content);
    });

    L.marker([10.323128259694728, 123.96872686159608], {
        icon: L.divIcon({
            className: 'custom-div-icon', // Add custom styles if needed
            html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="28" height="25"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path stroke="#fff" stroke-width="20" fill="#228B22" d="M396.6 6.5L235.8 129.1c9.6 1.8 18.9 5.8 27 12l168 128c13.2 10.1 22 24.9 24.5 41.4l6.2 41.5L608 352c9.3 0 18.2-4.1 24.2-11.1s8.8-16.4 7.4-25.6l-24-160c-1.2-8.2-5.6-15.7-12.3-20.7l-168-128c-11.5-8.7-27.3-8.7-38.8 0zm-153.2 160c-11.5-8.7-27.3-8.7-38.8 0l-168 128c-6.6 5-11 12.5-12.3 20.7l-24 160c-1.4 9.2 1.3 18.6 7.4 25.6S22.7 512 32 512l144 0 16 0c17.7 0 32-14.3 32-32l0-118.1c0-5.5 4.4-9.9 9.9-9.9c3.7 0 7.2 2.1 8.8 5.5l68.4 136.8c5.4 10.8 16.5 17.7 28.6 17.7l60.2 0 16 0c9.3 0 18.2-4.1 24.2-11.1s8.8-16.4 7.4-25.6l-24-160c-1.2-8.2-5.6-15.7-12.3-20.7l-168-128z"/></svg>', // SVG icon for tents
            iconSize: [18, 18],
            iconAnchor: [16, 25],
            popupAnchor: [0, -32]
        })
    })
    .addTo(map)
    .bindPopup('Evaction Site')
    .on('click', function(e) {
        L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
        var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Evacuation Site</h5>
                    <div style="padding: 10px;">
                        Safe zone for evacuation during typhoons.
                        <img src="PicturesNeeded/EvacuationSite3.png" alt="Evacuation Site" style="max-width: 100%; height: auto; margin-top: 10px;">
                    </div>`;
        toggleSidebar(content);
    });
    //fire prone area
    L.marker([10.325594, 123.969387], {
        icon: L.divIcon({
            className: 'custom-div-icon', // Add custom styles if needed
            html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28" height="25"><path stroke="#fff" stroke-width="20" fill="#FF4500" d="M323.5 51.25C302.8 70.5 284 90.75 267.4 111.1C240.1 73.62 206.2 35.5 168 0C69.75 91.12 0 210 0 281.6C0 408.9 100.2 512 224 512s224-103.1 224-230.4C448 228.4 396 118.5 323.5 51.25zM304.1 391.9C282.4 407 255.8 416 226.9 416c-72.13 0-130.9-47.73-130.9-125.2c0-38.63 24.24-72.64 72.74-130.8c7 8 98.88 125.4 98.88 125.4l58.63-66.88c4.125 6.75 7.867 13.52 11.24 20.2C364.9 290.6 353.4 357.4 304.1 391.9z"/></svg>', 
            iconSize: [18, 18],            
            iconAnchor: [16, 25],
            popupAnchor: [0, -32]
        })
    })
    .addTo(map)
    .bindPopup('Fire Prone Area')
    .on('click', function(e) {
        L.DomEvent.stopPropagation(e); // Prevent the click from reaching the map
        var content = `<h5 style="background-color: #f64a4a; color: white; padding:10px;">Fire Prone Area</h5>
                    <div style="padding: 10px;">
                        Prone to areas during fire incidents.
                        Firetrucks having difficulty reaching the area.
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