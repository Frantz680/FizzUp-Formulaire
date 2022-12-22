import '../css/appFront.scss';
import '../css/foundation.scss';
import '../css/foundationfloat.scss';

import $ from "jquery";

// **** sweetalert ****
import Swal from 'sweetalert2/dist/sweetalert2.js'
import '../css/sweetalert.scss';
import 'sweetalert2/src/sweetalert2.scss'
window.Swal = require('sweetalert2');

/******** ACTIF ********/


$( document ).ready(function() {
    //On regarde les evenements clic sur home-flex-title-subTitle
    $(".home-flex-title-subTitle").on("click", function () {

        //On déclare les variables
        let title = 'Votre avis compte';
        let title_success = 'Merci';

        Swal.fire({
            title: title,
            html: `<input type="text" id="login" class="swal2-input" placeholder="Username">
            <input type="password" id="password" class="swal2-input" placeholder="Password">`,
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: 'Envoyer',
            cancelButtonText: 'Annuler',
        }).then((result) => {

            if (result.isConfirmed) {

            $.ajax({

                url: url,
                data: {
                    'entityId': itemId,
                    'cible': page
                },
                method: 'POST',
                success: function (data) {
                    console.log(data);
                    Swal.fire({
                        icon: 'success',
                        title: title_success,
                    })
                    setInterval(function () {
                        location.reload();
                    }, 2000)
                },
                error: function () {
                    console.log("erreur 219");
                    // Swal.fire("Erreur", '', 'error')
                },
            });
        }
        else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
        })
    })
});