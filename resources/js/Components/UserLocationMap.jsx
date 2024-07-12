import React, { useEffect, useState } from 'react';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

const UserLocationMap = ({ setLocation }) => {
    const [latitude, setLatitude] = useState(null);
    const [longitude, setLongitude] = useState(null);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const position = await new Promise((resolve, reject) => {
                    navigator.geolocation.getCurrentPosition(resolve, reject);
                });

                setLatitude(position.coords.latitude);
                setLongitude(position.coords.longitude);

                // Pass latitude and longitude back to parent component
                setLocation({ latitude: position.coords.latitude, longitude: position.coords.longitude });
            } catch (error) {
                console.error("Error getting user location:", error);
            }
        };

        if (navigator.geolocation) {
            fetchData();
        } else {
            console.error("Geolocation is not supported by this browser.");
        }
    }, [setLocation]);

    useEffect(() => {
        if (latitude !== null && longitude !== null) {
            // Initialize Leaflet map
            const map = L.map('map', {
                center: [latitude, longitude],
                zoom: 16,
                minZoom: 4,
                maxZoom: 18,
                zoomControl: false,
                attributionControl: false
            });

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add marker
            L.marker([latitude, longitude]).addTo(map);

            return () => {
                map.remove(); // Clean up map
            };
        }
    }, [latitude, longitude]);

    return (
        <div id="map" style={{ height: '200px', width: '100%' }}></div>
    );
};

export default UserLocationMap;
