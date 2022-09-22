<style type="text/css">
	input, select, textarea {
		text-transform: uppercase;
		padding: 5px;
	}
</style>
<?php
require_once 'core/init.php';
	$find = mysqli_fetch_assoc(find_transaksi($_GET['id']) );
	// $tanggalfaktur = $find['tanggalfaktur']
	$tanggal = date("d-m-Y", strtotime($find['tanggal']));

?>
<form id="form">
	<table width="100%" cellspacing="0" id="customerData">
		<tr>
			<td>
				<label>No Faktur</label>
			</td>
			<td>
				<input type="text" id="nofaktur" readonly name="nofaktur" value="<?=$find['nofaktur']?>" class="FormElement ui-widget-content ui-corner-all" autocomplete="off">
			</td>
		</tr>
		<tr>
			<td>
				<label>Tanggal Faktur</label>
			</td>
			<td>
				<input type="text" readonly name="tanggal" value="<?=$tanggal?>" class="FormElement ui-widget-content ui-corner-all hasDatePicker" required autocomplete="off" maxlength="10">
			</td>
		</tr>
		<tr>
			<td>
				<label>Name Pelanggan</label>
			</td>
			<td>
				<input type="text" readonly name="nama" value="<?=$find['nama']?>" class="FormElement ui-widget-content ui-corner-all" required autocomplete="off">
			</td>
		</tr>
		<tr>
			<td>
				<label>Gender</label>
			</td>
			<td>
				<input type="text" readonly name="nama" value="<?=$find['genders']?>" class="FormElement ui-widget-content ui-corner-all" required autocomplete="off">
			</td>
		</tr>
		<tr>
			<td>
				<label>Phone</label>
			</td>
			<td>
				<input type="text" readonly name="phone" value="<?=$find['phone']?>" class="FormElement ui-widget-content ui-corner-all im-phone im-numeric" required autoco,digitalGroupSpacing:'4'mplete="off">
			</td>
		</tr>
		<tr>
			<td>
				<label>Saldo</label>
			</td>
			<td>
				<input type="text" readonly name="saldo" value="<?=$find['saldo']?>" class="FormElement ui-widget-content ui-corner-all im-currency" required autocomplete="off">
			</td>
		</tr>
		<tr>
			<td>
				<label>Address</label>
			</td>
			<td>
				<textarea readonly name="address" class="FormElement ui-widget-content ui-corner-all" required autocomplete="off"><?=$find['address']?></textarea>
			</td>
		</tr>

	</table>

	<br>

	<table width="100%" class="table ui-state-default" cellpadding="5" cellspacing="0" id="detailData">
		<thead>
			<tr>
			<th class="ui-th-div">Barang</th>
				<th class="ui-th-div">Harga</th>
				<th class="ui-th-div">Qty</th>
				<th class="ui-th-div">Total Harga</th>
			</tr>
		</thead>
		<tbody>
			<tr></tr>
		</tbody>
	</table>
</form>


<script type="text/javascript">
	$(document).ready(function() {
		let index = 0

		setDateFormat()
		setNumericFormat()
		formBindKeys()
	})

	function setDateFormat() {
		$('.hasDatePicker').datepicker({
			dateFormat: 'dd-mm-yyyy',
			yearRange: '2000:2099'
		}).inputmask({
			inputFormat: "dd-mm-yyyy",
			alias: "datetime",
			// minYear: '2000-01-01'
		})
		.focusout(function(e) {
			let val = $(this).val()
			if (val.match('[a-zA-Z]') == null) {
				if (val.length == 8) {
					$(this).inputmask({
						inputFormat: "dd-mm-yyyy",
					}).val([val.slice(0, 6), '20', val.slice(6)].join(''))
				}
			} else {
				$(this).focus()
			}
		})
		.focus(function() {
			let val = $(this).val()
			if (val.length == 10) {
				$(this).inputmask({
					inputFormat: 'dd-mm-yyyy',
				}).val([val.slice(0, 6), '', val.slice(8)].join(''))
			}
		})
	}

	function setNumericFormat() {
		$('.im-numeric').keypress(function(e){
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			  return false;
			}
		})
		
		$('.im-currency').inputmask('integer', {
			alias: 'numeric',
			groupSeparator: ',',
			autoGroup: true,
			digitsOptional: false,
			allowMinus: false,
			placeholder: '',
		}).css('text-align', 'right');
    }
    $('.im-phone').inputmask("+62 999-9999-99999");

	$.ajax({
		url: baseUrl + 'ajax.php?cari=gender',
		type: 'GET',
		dataType: 'JSON',
		success: function(res) {
			var idgenderphp = <?=$find['gender_id'];?>;
			res.forEach(function(el, i) {
				if (idgenderphp == el.id_gender) {
					$('#gender').append(`
						<option selected value="${el.id_gender}">${el.gender}</option>
					`)
				}else {
					$('#gender').append(`
						<option value="${el.id_gender}">${el.gender}</option>
					`)
				}
				$('#gender').select2()
			})
		}
	})

	$.ajax({
		url: baseUrl + 'ajax.php?cari=detailshow&transaksi_id=<?=$find['id']?>',
		type: 'GET',
		dataType: 'JSON',
		success: function(res) {
			res.forEach(function(el, i) {
				total = el.harga * el.quantity;
				$('#detailData tbody tr').last().before(`
				<tr>
					<td>
						<input type="text" value="${el.barang}" readonly name="barang[]" class="FormElement ui-widget-content ui-corner-all" required autocomplete="off">
					</td>
					<td>
						<input type="text" id="harga${el.id_detail}" value="${el.harga}" readonly name="harga[]" onkeyup="cal(${el.id_detail})" class="hargaCal FormElement ui-widget-content ui-corner-all im-numeric im-currency formcur" required autocomplete="off">
					</td>
					<td>
						<input type="text" id="qty${el.id_detail}" value="${el.quantity}" readonly name="qty[]" onkeyup="cal(${el.id_detail})" class="qtyCal FormElement ui-widget-content ui-corner-all im-currency" required autocomplete="off">
					</td>
					<td>
						<input type="text" id="total_item${el.id_detail}" readonly value="${total}" readonly name="total_item[]" class="FormElement ui-widget-content ui-corner-all im-numeric im-currency formcur" required autocomplete="off">
					</td>
					
					
				</tr>
				`)
				setNumericFormat();
				
			})
		}
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
