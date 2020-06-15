import Vue from "vue";
import firebase from "firebase";
import axios from "axios";

const firebaseConfig = {
  apiKey: object.fbApiKey,
  authDomain: object.authDomain,
  databaseURL: object.databaseURL,
  projectId: object.projectId,
  storageBucket: object.storageBucket,
  messagingSenderId: object.messagingSenderId,
  appId: object.appId,
  measurementId: object.measurementId,
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

window.addEventListener("load", function() {
  new Vue({
    el: "#upload",
    data: {
      selectedFile: null,
      imageData: null,
      picture: null,
      uploadValue: 0,
    },
    methods: {
      onFileSelected(event) {
        let isValid =
          event.target.files[0].size > 2097152
            ? event.target.files[0].size < 209715200
            : false;
        if (isValid) {
          this.uploadValue = 0;
          this.picture = null;
          this.imageData = event.target.files[0];
        }
      },
      onUpload() {
        this.picture = null;
        const storageRef = firebase
          .storage()
          .ref(`${this.imageData.name}`)
          .put(this.imageData);
        storageRef.on(
          `state_changed`,
          (snapshot) => {
            this.uploadValue =
              (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
          },
          (error) => {
            console.log(error.message);
          },
          () => {
            this.uploadValue = 100;
            storageRef.snapshot.ref.getDownloadURL().then((url) => {
              this.picture = url;
              console.log(url);
              let formData = new FormData();
              formData.append("action", "itbz_upload");
              formData.append("nonce", object.nonce);
              formData.append("customer", object.customer);
              formData.append("product", object.specialproduct);
              formData.append("url", url);

              axios
                .post(object.ajaxurl, formData)
                .then(function(response) {
                  console.log(response.data);
                })
                .catch(function(error) {
                  console.log(error);
                });
            });
          }
        );
      },
    },
  });
});
