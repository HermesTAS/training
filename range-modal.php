<style type="text/css">
	input, select, textarea {
		text-transform: uppercase;
		padding: 5px;
	}
</style>

<form id="transaksiForm">
	<table width="100%" cellspacing="0" id="customerData">
	<tr>
		<td>
			<label>From</label>
		</td>
		<td>
		<input type="number" class="FormElement ui-widget-content ui-corner-all" name="from" value="1" min="1" max="<?=$_GET['total']?>">

		</td>
	</tr>
	<tr>
		<td>
		<label>To</label>

		</td>
		<td>
			<input type="number" class="FormElement ui-widget-content ui-corner-all" name="to" value="<?=$_GET['total']?>" min="1" max="<?=$_GET['total']?>">
		</td>
	</tr>
</table>
</form>
		

<script type="text/javascript">
	$(document).ready(function() {
		let index = 0

		formBindKeys()
	})


	function formBindKeys() {
		let inputs = $('#customerForm [name]:not(:hidden)')
		let element
		let position

		inputs.each(function(i, el) {
			$(el).attr('data-input-index', i)
		})

		$(inputs[0]).focus()

		inputs.focus(function() {
			$(this).data('input-index')
		})

		inputs.keydown(function(e) {
			let operator
			switch(e.keyCode) {
				case 38:
					element = $(inputs[$(this).data('input-index') - 1])
					if (element.is(':not(select)') && element.attr('type') !== 'email') {
						position = element.val().length
						element[0].setSelectionRange(position, position)
					}
					element.hasClass('hasDatePicker')
						? $('.ui-datepicker').show()
						: $('.ui-datepicker').hide()
					element.focus()
					break
				case 40:
					element = $(inputs[$(this).data('input-index') + 1])
					if (element.is(':not(select)') && element.attr('type') !== 'email') {
						position = element.val().length
						element[0].setSelectionRange(position, position)
					}
					element.hasClass('hasDatePicker')
						? $('.ui-datepicker').show()
						: $('.ui-datepicker').hide()
					element.focus()
					break
			}
		})
	}
</script>
