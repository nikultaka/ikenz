<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<input type="file" name="file">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<img clas="preview" src="">
<script>
$('input[name=file]').change(function()
{	var token=$("#token").val();
	// AJAX Request
        
	$.post( 'MediaUploadController', {_token:token,file: $(this).val()} )
		.done(function( data )
		{
			if(data.error)
			{
				// Log the error
				console.log(error);
			}
			else
			{
				// Change the image attribute
				$( 'img.preview' ).attr( 'src', data.path );
			}
		});
});
</script>