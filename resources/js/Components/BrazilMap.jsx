import React, { useEffect } from 'react';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export default function BrazilMap({ sales }) {
    useEffect(() => {
        const brazilBounds = [
            [-33.75, -73.99],
            [5.27, -34.79]
        ];

        const map = L.map('map', {
            center: [-14.235, -51.9253],
            zoom: 4,
            minZoom: 4,
            maxZoom: 18,
            zoomControl: false,
            attributionControl: false,
            maxBounds: brazilBounds,
            maxBoundsViscosity: 1.0
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        }).addTo(map);

        sales.forEach(item => {
            const { unidade, total_sales, latitude, longitude } = item;

            const marker = L.marker([latitude, longitude]).addTo(map);
            marker.bindPopup(unidade);

            const salesValue = parseFloat(total_sales.replace(',', '.'));

            const radius = salesValue * 40;

            L.circle([latitude, longitude], {
                color: 'blue',
                fillColor: '#3388ff',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        });

        return () => {
            map.remove();
        };
    }, [sales]);

    return (
        <div id="map" style={{ height: '600px' }}></div>
    );
}
