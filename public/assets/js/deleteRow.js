import Swal from 'sweetalert2/dist/sweetalert2.js'

import 'sweetalert2/src/sweetalert2.scss'

        //deleterow
        function DeleteRow(id, url) {
            var message = Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        datatype: 'JSON',
                        data: {
                            id
                        },
                        url: url,
                        success: function(result) {
                            console.log(result);
                        }
                    });
                }
            })

        }