//********tab***********************
function OpenTab(num)
{
	if(num == "")
	{
		//if (document.Form1.hdtab.value != "")
		//{
		//	num = document.Form1.hdtab.value;
		//}
		//else
		//{
		//	num = "1";
		//}
		
		num = "1";
	}
	//document.Form1.hdtab.value = num;
	if (num == "1")
	{
	tabone.style.display="";
	linktabone.className="tabSelected";
	tabtwo.style.display="none";
	linktabtwo.className="tabNotSelected";
	tabthree.style.display="none";
	linktabthree.className="tabNotSelected";
	}
	else if (num == "2")
	{
	tabone.style.display="none";
	linktabone.className="tabNotSelected";
	tabtwo.style.display="";
	linktabtwo.className="tabSelected";
	tabthree.style.display="none";
	linktabthree.className="tabNotSelected";
	}
	else if (num == "3")
	{
	tabone.style.display="none";
	linktabone.className="tabNotSelected";
	tabtwo.style.display="none";
	linktabtwo.className="tabNotSelected";
	tabthree.style.display="";
	linktabthree.className="tabSelected";
	}

}

function OpenTab2(num)
{
	if(num == "")
	{
		if (document.all.hdtab.value != "")
		{
			num = document.all.hdtab.value;
		}
		else
		{
			num = "1";
		}
	}
	document.all.hdtab.value = num;
	if (num == "1")
	{
	tabone.style.display="";
	linktabone.className="tabSelected";
	tabtwo.style.display="none";
	linktabtwo.className="tabNotSelected";
	}
	else if (num == "2")
	{
	tabone.style.display="none";
	linktabone.className="tabNotSelected";
	tabtwo.style.display="";
	linktabtwo.className="tabSelected";
	}
}

function OpenTab3(num)
{
	if(num == "")
	{
		if (document.all.hdtab.value != "")
		{
			num = document.frm_register.hdtab.value;
		}
		else
		{
			num = "1";
		}
	}
	document.all.hdtab.value = num;
	if (num == "1")
	{
		tabone.style.display="";
		linktabone.className="tabSelected";
		tabtwo.style.display="none";
		linktabtwo.className="tabNotSelected";
		tabthree.style.display="none";
		linktabthree.className="tabNotSelected";
	}
	else if (num == "2")
	{
		tabone.style.display="none";
		linktabone.className="tabNotSelected";
		tabtwo.style.display="";
		linktabtwo.className="tabSelected";
		tabthree.style.display="none";
		linktabthree.className="tabNotSelected";
	}
	else if (num == "3")
	{
		tabone.style.display="none";
		linktabone.className="tabNotSelected";
		tabtwo.style.display="none";
		linktabtwo.className="tabNotSelected";
		tabthree.style.display="";
		linktabthree.className="tabSelected";
	}

}


//Aek : เพิ่มสำหรับ 4 Tab
function OpenTab4(num)
{
	if(num == "")
	{
		if (document.all.hdtab.value != "")
		{
			num = document.Form1.hdtab.value;
		}
		else
		{
			num = "1";
		}
	}
	document.Form1.hdtab.value = num;
	if (num == "1")
	{
	tabone.style.display="";
	linktabone.className="tabSelected";
	tabtwo.style.display="none";
	linktabtwo.className="tabNotSelected";
	tabthree.style.display="none";
	linktabthree.className="tabNotSelected";
	tabfour.style.display="none";
	linktabfour.className="tabNotSelected";
	}
	else if (num == "2")
	{
	tabone.style.display="none";
	linktabone.className="tabNotSelected";
	tabtwo.style.display="";
	linktabtwo.className="tabSelected";
	tabthree.style.display="none";
	linktabthree.className="tabNotSelected";
	tabfour.style.display="none";
	linktabfour.className="tabNotSelected";
	}
	else if (num == "3")
	{
	tabone.style.display="none";
	linktabone.className="tabNotSelected";
	tabtwo.style.display="none";
	linktabtwo.className="tabNotSelected";
	tabthree.style.display="";
	linktabthree.className="tabSelected";
	tabfour.style.display="none";
	linktabfour.className="tabNotSelected";
	}
	else if (num == "4")
	{
	tabone.style.display="none";
	linktabone.className="tabNotSelected";
	tabtwo.style.display="none";
	linktabtwo.className="tabNotSelected";
	tabthree.style.display="none";
	linktabthree.className="tabNotSelected";
	tabfour.style.display="";
	linktabfour.className="tabSelected";
	}
}

function OpenTabFin(num)
{
	if(num == "")
	{
		if (document.Form1.hdtab.value != "")
		{
			num = document.Form1.hdtab.value;
		}
		else
		{
			num = "1";
		}
	}
	document.Form1.hdtab.value = num;
	if (num == "1")
	{
	tabone.style.display="";
	linktabone.className="tabSelected";
	tabtwo.style.display="none";
	linktabtwo.className="tabNotSelected";
	tabthree.style.display="none";
	linktabthree.className="tabNotSelected";
	}
	else if (num == "2")
	{
	tabone.style.display="none";
	linktabone.className="tabNotSelected";
	tabtwo.style.display="";
	linktabtwo.className="tabSelected";
	tabthree.style.display="none";	
	linktabthree.className="tabNotSelected";
	}
	else if (num == "3")
	{
	tabone.style.display="none";
	linktabone.className="tabNotSelected";
	tabtwo.style.display="none";
	linktabtwo.className="tabNotSelected";
	tabthree.style.display="";
	linktabthree.className="tabSelected";
	}
}

//******* Cal ชำระอื่น ๆ ใน txtTotalOtherPay
function CalTotalOtherPay(field,txtTotalOtherPay) 
{
    var otherpay; //จำนวนชำระอื่น ๆ
    otherpay = field.value;
    otherpay = 100;
    
    document.getElementById("txtTotalOtherPay").value = RoundDigit(otherpay,2);
}

