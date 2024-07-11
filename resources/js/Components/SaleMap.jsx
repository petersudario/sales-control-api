import React, { useEffect, useRef } from 'react';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export default function SaleMap({ sale }) {

    useEffect(() => {
        if (!sale || !sale.latitude || !sale.longitude) {
            return;
        }

        const bounds = L.latLngBounds([
            [sale.latitude - 0.01, sale.longitude - 0.01], 
            [sale.latitude + 0.01, sale.longitude + 0.01]  
        ]);

        const map = L.map('map', {
            center: [sale.latitude, sale.longitude], 
            zoom: 16, 
            minZoom: 16, 
            maxZoom: 18, 
            zoomControl: true, 
            attributionControl: true, 
            maxBounds: bounds, 
            maxBoundsViscosity: 1.0
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([sale.latitude, sale.longitude]).addTo(map);

        return () => {
            map.remove();
        };
    }, [sale]);

    return (
        <div id="map" style={{ height: '200px', width: '200px' }}></div>
    );
};
