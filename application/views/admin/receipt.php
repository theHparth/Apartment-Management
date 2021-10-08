<!DOCTYPE html>
<html>
<head>
	<title>Maintenance Receipt</title>
</head>
<body style='font-size: 0.8rem; font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";'>
<!-- <div style="text-align: right;">ORIGINAL</div> -->
<fieldset>
	<!-- #0f6eb5 -->
	<style>
            tr td:first-child { padding :2px 5px 2px 5px;}
            tr td:last-child {padding:2px 5px 2px 5px;}
            tr td:last-child span{
            padding-right: 10px;
            font-weight: 700;
            }
        </style>
	<table border="1" width="100%" style="table-layout: auto; line-height: 1.5;border-collapse: collapse;border:thin solid #81b2d6; ">
		<tr>
			<td colspan="4">
				<div style="display:flex;">
				   <div style="width:80%;text-align:center;">
					<h2 style="color: red;font-size:21px;">THE ORCHID ELIGANCE CO. OP. HOUSING<br> AND COMMERCIAL SERVICE SOCIETY LTD.</h2>
				   </div>
				   <div style="width:20%;">
					<img style="width:100px;float:right;margin-right:5px;" src="ork.jpeg">
				   </div>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="padding:1px;">
				<div style="font-size:11px;font-weight: 600;text-align: center;">NR. MNOHARVILL CROSS ROAD, NIKOL NARODA ROAD, NAVA NARODA, AHMEDABAD - 382330</div>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="padding:1px;">
				<div style="font-size:11px;font-weight: 600;text-align: center;">REG.NO./AHD/SA(HAA)11340 Dt. 10-05-2018 PAN NO. AAIAT9470A</div>
			</td>
		</tr>
		<tr>
			<th colspan="4">ORIGINAL</th>
		</tr>
		<tr style="border-bottom:thin solid #81b2d6;">
			<td colspan="2" style="width: 70%;">
				Name : <?=$data['name'];?> <br>
				Home / Shop No. : <?=$data['h_no'];?> <br>
				<br>
			</td>
			<td colspan="2" style="width: 30%;">
				Receipt Number : <?=$data['id'];?><br>
				Date : <?=date('d-m-Y',strtotime($data['created_at'])); ?><br><br>
			</td>
		</tr>
		<tr style="border-bottom:thin solid #81b2d6;color: #505292;">
			<th style="width: 10%;">Sr. No.</th>
			<th style="width: 70%;" colspan="2">Description</th>
			<th style="width: 20%;">Amount (₹)</th>
		</tr>

		<?php $i=1; 
		if($data['name'])
		?>

		<tr style="text-align: center;">
			<td style="width: 10%;">1</td>
			<td style="width: 70%;" colspan="2">Maintenance</td>
			<td style="width: 20%;">1000</td>
		</tr>
		
		<tr>
			<td colspan="3" style="width: 80%;text-align: right;"><b>Total Amount : </b></td>
			<td style="width: 20%;">1500</td>
		</tr>
		
		<tr>
			<th style="color: red;" colspan="4">Payment Information</th>
		</tr>
		<tr>
			<td style="border-bottom:thin solid #81b2d6;width: 80%;" colspan="3">
				Payment By : Online <br>
				Cheque/DD/Tran. Number : 8751468475455884 <br>
				Bank Name      : Kotak <br>
				
			</td>
			<!-- <table><tr></tr></table> -->
			<td align="center" style="vertical-align: bottom;">
				<span>Receiver Signature</span> 
			</td>
		</tr>
		<tr><th colspan="4">" PLEASE PAY MAINTENANCE REGULARLY "</th></tr>
	</table>
	
</fieldset>
<div style="border-width:2px;border-bottom-style:dashed;margin: 10px 0 10px;"></div>
<fieldset>
	<!-- #0f6eb5 -->
	<table border="1" width="100%" style="table-layout: auto; line-height: 1.5;border-collapse: collapse;border:thin solid #81b2d6; ">
		<tr>
			<td colspan="4">
				<div style="display:flex;">
				   <div style="width:80%;text-align:center;">
					<h2 style="color: red;font-size:21px;">THE ORCHID ELIGANCE CO. OP. HOUSING<br> AND COMMERCIAL SERVICE SOCIETY LTD.</h2>
				   </div>
				   <div style="width:20%;">
					<img style="width:100px;float:right;margin-right:5px;" src="ork.jpeg">
				   </div>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="padding:1px;">
				<div style="font-size:11px;font-weight: 600;text-align: center;">NR. MNOHARVILL CROSS ROAD, NIKOL NARODA ROAD, NAVA NARODA, AHMEDABAD - 382330</div>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="padding:1px;">
				<div style="font-size:11px;font-weight: 600;text-align: center;">REG.NO./AHD/SA(HAA)11340 Dt. 10-05-2018 PAN NO. AAIAT9470A</div>
			</td>
		</tr>
		<tr>
			<th colspan="4">DUPLICATE</th>
		</tr>
		<tr style="border-bottom:thin solid #81b2d6;">
			<td colspan="2" style="width: 70%;">
				Name : Kishan Babubhai Patel <br>
				Home / Shop No. : 20 ,Krushnakunj Society ,Varachha ,Surat <br>
				<br>
			</td>
			<td colspan="2" style="width: 30%;">
				Receipt Number : BH/20-21/0001<br>
				Date : 12/05/2020<br><br>
			</td>
		</tr>
		<tr style="border-bottom:thin solid #81b2d6;color: #505292;">
			<th style="width: 10%;">Sr. No.</th>
			<th style="width: 70%;" colspan="2">Description</th>
			<th style="width: 20%;">Amount (₹)</th>
		</tr>
		<tr style="text-align: center;">
			<td style="width: 10%;">1</td>
			<td style="width: 70%;" colspan="2">Maintenance</td>
			<td style="width: 20%;">1000</td>
		</tr>
		
		<tr>
			<td colspan="3" style="width: 80%;text-align: right;"><b>Total Amount : </b></td>
			<td style="width: 20%;">1500</td>
		</tr>
		
		<tr>
			<th style="color: red;" colspan="4">Payment Information</th>
		</tr>
		<tr>
			<td style="border-bottom:thin solid #81b2d6;width: 80%;" colspan="3">
				Payment By : Online <br>
				Cheque/DD/Tran. Number : 8751468475455884 <br>
				Bank Name      : Kotak <br>
				
			</td>
			<!-- <table><tr></tr></table> -->
			<td align="center" style="vertical-align: bottom;">
				<span>Receiver Signature</span> 
			</td>
		</tr>
		<tr><th colspan="4">" PLEASE PAY MAINTENANCE REGULARLY "</th></tr>
	</table>
	
</fieldset>
</body>
</html>