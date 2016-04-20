/***********************
* Adobe Edge Animate Composition Actions
*
* Edit this file with caution, being careful to preserve 
* function signatures and comments starting with 'Edge' to maintain the 
* ability to interact with these actions from within Adobe Edge Animate
*
***********************/
(function($, Edge, compId){
var Composition = Edge.Composition, Symbol = Edge.Symbol; // aliases for commonly used Edge classes

   //Edge symbol: 'stage'
   (function(symbolName) {
      
      
      Symbol.bindElementAction(compId, symbolName, "document", "compositionReady", function(sym, e) {
         // load JSON
         //$.getJSON("exam.json")
         
         //$.getJSON("http://www.tgde.kmutnb.ac.th/tct2/testJson.php")
         $.getJSON("http://www.codeunbug.com/dft/Project/json/json_1.1.php")
         	.success(
         		function(data){
         
         			console.log("incoming data : ", data);
         			$.each(data, function(index,item){
         			sym.$("maya").html(item.aa);
         			var s = sym.createChildSymbol("template","content");
         			//s.$("t1").html(item.product1);
         			//s.$("t2").html(item.b);
         			//s.$("mc").css({"background-image":"'url('profile/"+item.a+".jpg')'"});
         			//s.$("mc").css({"background-image":"url("+"'profile/"+item.a+".jpg'"+")"});
         			//s.$("num").html(index+1);
         			//s.play(index * -500);
         		});
         }
         );

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 0, function(sym, e) {
         // insert code here
      });
      //Edge binding end

   })("stage");
   //Edge symbol end:'stage'

   //=========================================================
   
   //Edge symbol: 'template'
   (function(symbolName) {   
   
      

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 5005, function(sym, e) {
         sym.play("loop");

      });
      //Edge binding end

   })("template");
   //Edge symbol end:'template'

})(window.jQuery || AdobeEdge.$, AdobeEdge, "EDGE-13749049");