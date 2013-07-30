   function jumpMenu(target,selObj,restore)
   {
      eval(target+".location='"+selObj.options[selObj.selectedIndex].value+"'");
      if (restore)
      {
         selObj.selectedIndex=0;
      }
   }