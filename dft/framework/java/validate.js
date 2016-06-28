function validateForms(form_name)
{
	    var blnvalidate = true;
		
		if (!document.getElementsByTagName) return false;
		
		elementsForms =document.getElementsByTagName('form');
		for (var intCounter = 0; intCounter < elementsForms.length; intCounter++)
		{
			//alert(elementsForms[intCounter].id);
			
			if (form_name==elementsForms[intCounter].id)
			{
				//alert(form_name);
				if(validateForm(elementsForms[intCounter])==false)
				{
					blnvalidate = false;
					break;
				}
			}
		
		}
		return blnvalidate;
 }
function validateForm(currentForm)
{
	//alert("dddd");
	var blnvalidate = true;
	var elementsInputs;
	elementsInputs = currentForm.getElementsByTagName("input");
	elementsSELECT = currentForm.getElementsByTagName("SELECT");
	elementsTEXTAREA = currentForm.getElementsByTagName("TEXTAREA");
	//SELECT
	//TEXTAREA
	for (var intCounter = 0; intCounter < elementsInputs.length; intCounter++)
	{
		//alert(elementsInputs[intCounter].class);
	if (elementsInputs[intCounter].className == "reqstring")
	{
		if (validateText(elementsInputs, intCounter))
		{
			blnvalidate = false;
			alert( elementsInputs[intCounter].alt);
			elementsInputs[intCounter].focus();
			break;
		}
	}
	else	if (elementsInputs[intCounter].className == "nullreqstring")
	{
		//if (validateText(elementsInputs, intCounter))
	//	{
		//	blnvalidate = false;
		//	alert( elementsInputs[intCounter].alt);
		//	elementsInputs[intCounter].focus();
		//	break;
		//}
	}
	else if (elementsInputs[intCounter].className == "reqemail")
	{
		if (validateEmail(elementsInputs, intCounter))
		{
				blnvalidate = false;
				alert(elementsInputs[intCounter].alt);
				elementsInputs[intCounter].focus();
				break;
		}
	}
		else if (elementsInputs[intCounter].className == "reqnullemail")
	{
		if (validateNullEmail(elementsInputs, intCounter))
		{
				blnvalidate = false;
				alert(elementsInputs[intCounter].alt);
				elementsInputs[intCounter].focus();
				break;
		}
	}
	else if (elementsInputs[intCounter].className == "reqnumber")
	{
		if ( validateNumber(elementsInputs, intCounter))
		{
				blnvalidate = false;
				alert(elementsInputs[intCounter].alt);
				elementsInputs[intCounter].focus();
				break;
		}
	}
		else if (elementsInputs[intCounter].className == "reqnullnumber")
	{
		if ( validateNullNumber(elementsInputs, intCounter))
		{
				blnvalidate = false;
				alert(elementsInputs[intCounter].alt);
				elementsInputs[intCounter].focus();
				break;
		}
	}
	else if (elementsInputs[intCounter].className == "reqdateformat")
	{
		if ( validatedateformat(elementsInputs, intCounter))
		{
				blnvalidate = false;
				alert(elementsInputs[intCounter].alt);
				elementsInputs[intCounter].focus();
				break;
		}
	}
		else if (elementsInputs[intCounter].className == "reqnulldateformat")
	{
		if ( validateNulldateformat(elementsInputs, intCounter))
		{
				blnvalidate = false;
				alert(elementsInputs[intCounter].alt);
				elementsInputs[intCounter].focus();
				break;
		}
	}
	else if (elementsInputs[intCounter].className == "reqimage")
	{
		if ( validateimage(elementsInputs, intCounter))
		{
				blnvalidate = false;
				alert(elementsInputs[intCounter].alt);
				elementsInputs[intCounter].focus();
				break;
		}
	}
		else if (elementsInputs[intCounter].className == "reqnullimage")
	{
		if ( validateNullimage(elementsInputs, intCounter))
		{
				blnvalidate = false;
				alert(elementsInputs[intCounter].alt);
				elementsInputs[intCounter].focus();
				break;
		}
	}
	else if (elementsInputs[intCounter].className == "checkimage")
	{
		if ( checkimage(elementsInputs, intCounter))
		{
				blnvalidate = false;
				alert(elementsInputs[intCounter].alt);
				elementsInputs[intCounter].focus();
				break;
		}
	}
		else if (elementsInputs[intCounter].className == "checknullimage")
	{
	//	if ( checkNullimage(elementsInputs, intCounter))
		//{
			//	blnvalidate = false;
			//	alert(elementsInputs[intCounter].alt);
//elementsInputs[intCounter].focus();
			//	break;
	//	}
	}
	}
	if(blnvalidate==true)
	{
	for (var intCounter = 0; intCounter < elementsSELECT.length; intCounter++)
	{
	if (elementsSELECT[intCounter].className == "reqstring")
	{
		if (validateText(elementsSELECT, intCounter))
		{
			blnvalidate = false;
			alert( elementsSELECT[intCounter].alt);
			elementsSELECT[intCounter].focus();
			break;
		}
	}
	}
	}
	if(blnvalidate==true)
	{
	for (var intCounter = 0; intCounter < elementsTEXTAREA.length; intCounter++)
	{
	if (elementsTEXTAREA[intCounter].className == "reqstring")
	{
		if (validateText(elementsTEXTAREA, intCounter))
		{
			blnvalidate = false;
			alert( elementsTEXTAREA[intCounter].alt);
			elementsTEXTAREA[intCounter].focus();
			break;
		}
	}
	}
	}
	return blnvalidate;
 }
function validateEmail(elementsInputs, intCounter)
{
	var emailFilter=/^.+@.+\..{2,3}$/;
	if (!emailFilter.test(elementsInputs[intCounter].value))
	{
		return true;
	}
}
function validateNullEmail(elementsInputs, intCounter)
{
	var emailFilter=/^.+@.+\..{2,3}$/;
	if (elementsInputs[intCounter].value == "")
	{
		return false;
	}
	else if (!emailFilter.test(elementsInputs[intCounter].value))
	{
		return true;
	}
}
function validateText(elementsInputs, intCounter)
{
	if (elementsInputs[intCounter].value == "")
	{
		return true;
	}
}
function validateNumber(elementsInputs, intCounter)
{
	var NumberFilter=/^[0-9]+(\.[0-9]{1,2})?$/;
	if (!NumberFilter.test(elementsInputs[intCounter].value))
	{
		return true;
	}
}
function validateNullNumber(elementsInputs, intCounter)
{
	var NumberFilter=/^[0-9]+(\.[0-9]{1,2})?$/;
	if (elementsInputs[intCounter].value == "")
	{
		return false;
	}
	else if (!NumberFilter.test(elementsInputs[intCounter].value))
	{
		return true;
	}
}
function validatedateformat(elementsInputs, intCounter){
	var dateformat = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/;
	if (!dateformat.test(elementsInputs[intCounter].value))
	{
		return true;
	}
}
function validateNulldateformat(elementsInputs, intCounter){
	var dateformat = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/;
		if (elementsInputs[intCounter].value == "")
	{
		return false;
	}
	else if (!dateformat.test(elementsInputs[intCounter].value))
	{
		return true;
	}
}
function validateNullimage(elementsInputs, intCounter)
{
	   var image=elementsInputs[intCounter].value;
	   	if (elementsInputs[intCounter].value == "")
	{
		return false;
	}
	else{
		var Ntype=10;
		var FileType=new Array("gif","GIF","jpg","JPG","jpeg","JPEG","png","PNG","bmp","BMP");
		var FName ="";
		var check=0;
		for (var i=0;i<image.length;i++)
		{
    		if (image.charAt(i) == ".")
			{
				FName="";
			}
		else
			FName=FName+image.charAt(i);
		}
	
		for(i=0;i<Ntype;i++)
		{
			if (FileType[i]==FName) 
			{	
				 check=1;
				break;
			}
		}
  if(check)
  	return  false;
  else
	{
		 return true;
	}
	}
}
function checkimage(elementsInputs, intCounter)
{
	   var image=elementsInputs[intCounter].value;
	   var check=0;
	   if(image)
	 {
		var Ntype=10;
		var FileType=new Array("gif","GIF","jpg","JPG","jpeg","JPEG","png","PNG","bmp","BMP");
		var FName ="";
		
		for (var i=0;i<image.length;i++)
		{
    		if (image.charAt(i) == ".")
			{
				FName="";
			}
		else
			FName=FName+image.charAt(i);
		}
	
		for(i=0;i<Ntype;i++)
		{
			if (FileType[i]==FName) 
			{	
				 check=1;
				break;
			}
		}
	 }
	else
		check=1;
  if(check)
  	return  false;
  else
	{
		 return true;
	}
}
 function checkall(formname,checkname,thestate)
{
	
	var el_collection=eval("document.forms."+formname+"."+checkname)
//alert("�س�ѧ����͹������ ' "+"document.forms."+formname+"."+checkname+" ' ");
	for (c=0;c<el_collection.length;c++)
	{
		el_collection[c].checked=thestate;
		// alert("�س�ѧ����͹������ ' "+el_collection[c].checked+" ' ");
	}
}
  function ConfirmDel()
  {
		if (confirm("คุณต้องการลบข้อมูลใช้หรือไม่"))
			return true;
		else
			return false;
  }
  function ConfirmMsg(msg)
  {
		if (confirm(msg))
			return true;
		else
			return false;
}

 