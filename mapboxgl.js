mapboxgl.accessToken = "YOUR_MAPBOX_ACCESS_TOKEN";
const map = new mapboxgl.Map({
    container: "map", // container ID
    // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
    style: "mapbox://styles/mapbox/dark-v11", // style URL
    center: [-73.9709, 40.6712], // starting position [lng, lat]
    zoom: 15.773, // starting zoom
});

const geojson = {
    type: "FeatureCollection",
    features: [
        {
            type: "Feature",
            properties: {},
            geometry: {
                coordinates: [
                    [-73.97003, 40.67264],
                    [-73.96985, 40.67235],
                    [-73.96974, 40.67191],
                    [-73.96972, 40.67175],
                    [-73.96975, 40.67154],
                    [-73.96987, 40.67134],
                    [-73.97015, 40.67117],
                    [-73.97045, 40.67098],
                    [-73.97064, 40.67078],
                    [-73.97091, 40.67038],
                    [-73.97107, 40.67011],
                    [-73.97121, 40.66994],
                    [-73.97149, 40.66969],
                    [-73.97169, 40.66985],
                    [-73.97175, 40.66994],
                    [-73.97191, 40.66998],
                    [-73.97206, 40.66998],
                    [-73.97228, 40.67008],
                ],
                type: "LineString",
            },
        },
    ],
};

map.on("load", () => {
    map.addSource("line", {
        type: "geojson",
        data: geojson,
    });

    // add a line layer without line-dasharray defined to fill the gaps in the dashed line
    map.addLayer({
        type: "line",
        source: "line",
        id: "line-background",
        paint: {
            "line-color": "yellow",
            "line-width": 6,
            "line-opacity": 0.4,
        },
    });

    // add a line layer with line-dasharray set to the first value in dashArraySequence
    map.addLayer({
        type: "line",
        source: "line",
        id: "line-dashed",
        paint: {
            "line-color": "yellow",
            "line-width": 6,
            "line-dasharray": [0, 4, 3],
        },
    });

    // technique based on https://jsfiddle.net/2mws8y3q/
    // an array of valid line-dasharray values, specifying the lengths of the alternating dashes and gaps that form the dash pattern
    const dashArraySequence = [
        [0, 4, 3],
        [0.5, 4, 2.5],
        [1, 4, 2],
        [1.5, 4, 1.5],
        [2, 4, 1],
        [2.5, 4, 0.5],
        [3, 4, 0],
        [0, 0.5, 3, 3.5],
        [0, 1, 3, 3],
        [0, 1.5, 3, 2.5],
        [0, 2, 3, 2],
        [0, 2.5, 3, 1.5],
        [0, 3, 3, 1],
        [0, 3.5, 3, 0.5],
    ];

    let step = 0;

    function animateDashArray(timestamp) {
        // Update line-dasharray using the next value in dashArraySequence. The
        // divisor in the expression `timestamp / 50` controls the animation speed.
        const newStep = parseInt((timestamp / 50) % dashArraySequence.length);

        if (newStep !== step) {
            map.setPaintProperty(
                "line-dashed",
                "line-dasharray",
                dashArraySequence[step]
            );
            step = newStep;
        }

        // Request the next frame of the animation.
        requestAnimationFrame(animateDashArray);
    }

    // start the animation
    animateDashArray(0);
});

map.on("load", () => {
    map.addSource("route", {
        type: "geojson",
        data: {
            type: "Feature",
            properties: {},
            geometry: {
                type: "LineString",
                coordinates: [
                    [-122.483696, 37.833818],
                    [-122.483482, 37.833174],
                    [-122.483396, 37.8327],
                    [-122.483568, 37.832056],
                    [-122.48404, 37.831141],
                    [-122.48404, 37.830497],
                    [-122.483482, 37.82992],
                    [-122.483568, 37.829548],
                    [-122.48507, 37.829446],
                    [-122.4861, 37.828802],
                    [-122.486958, 37.82931],
                    [-122.487001, 37.830802],
                    [-122.487516, 37.831683],
                    [-122.488031, 37.832158],
                    [-122.488889, 37.832971],
                    [-122.489876, 37.832632],
                    [-122.490434, 37.832937],
                    [-122.49125, 37.832429],
                    [-122.491636, 37.832564],
                    [-122.492237, 37.833378],
                    [-122.493782, 37.833683],
                ],
            },
        },
    });
    map.addLayer({
        id: "route",
        type: "line",
        source: "route",
        layout: {
            "line-join": "round",
            "line-cap": "round",
        },
        paint: {
            "line-color": "#888",
            "line-width": 8,
        },
    });
});
