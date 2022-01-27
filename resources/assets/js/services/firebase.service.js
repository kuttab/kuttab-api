// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyBvs4xSVYAbWaCKmUZRL2aFjUJ4nRjK5AA",
    authDomain: "push-notifications-54f0c.firebaseapp.com",
    projectId: "push-notifications-54f0c",
    storageBucket: "push-notifications-54f0c.appspot.com",
    messagingSenderId: "439482608695",
    appId: "1:439482608695:web:a0f70f088932ee0b86a3b2",
    measurementId: "G-90RXR6GH15"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

// Get a list of cities from your database
async function getCities(db) {
    const citiesCol = collection(db, 'cities');
    const citySnapshot = await getDocs(citiesCol);
    const cityList = citySnapshot.docs.map(doc => doc.data());
    return cityList;
}
