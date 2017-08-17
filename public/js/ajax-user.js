/**
 * GYet the data and output the id and name form the user in the model.
 *
 * @param {string} hyperlink - The data hyperlink
 * @param {string} modalName - The name for the modal that should be triggered.
 */
function getDataById(hyperlink, modalName) {
    $('#form')[0].reset(); // Reset forms on modal.

    // AJAX load data from the url.
    $.ajax({
        url : hyperlink,
        type : "GET",
        dataType: "JSON",
        success: function (data) {
            // Console.log(data);
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);

            // Trigger modal.
            $(modalName).modal('show'); // Show bootstrap model when complete loading.
        },

        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error getting data from ajax.');
        }
    });
}