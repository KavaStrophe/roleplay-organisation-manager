function inputError(elem)
{
	$(elem).css('border-color', 'red');
	$(elem).on('click', function(){
		$(this).css('border-color', '#272d35')
	});
}

function redirectButton(elem, url)
{
	$(elem).on('click', function(){
		window.location = url;
	});
}