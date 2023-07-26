$('#modalfiledownload').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
	$('#imgmodaldownload').attr('src',recipient);
	$('#urlmodaldownload').attr('href',recipient);
})