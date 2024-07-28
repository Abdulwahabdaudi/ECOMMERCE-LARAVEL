import Swal from 'sweetalert2'

const submitSuccess = (message) => {
    Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    }).fire({
        icon: 'success',
        title: 'Product ' + message + ' success'
    })
}

const submitError = (message) => {
    Swal.fire({
        title: "Oops Error Something went wrong!!!",
        text: " " + message,
        icon: "error"
    })
}

export {
    submitError,
    submitSuccess
}
