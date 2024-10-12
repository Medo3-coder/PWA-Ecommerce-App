import React from "react";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import NavMenuMobile from "../components/common/NavMenuMoblie";
import FooterDesktop from "../components/common/FooterDesktop";
import FooterMobile from "../components/common/FooterMobile";
import Purchase from "../components/others/Purchase";

const PurchasePage = () => {
  
  return (
    <>
         <div className="Desktop">
                <NavMenuDesktop /> 
               </div>

               <div className="Mobile">
               <NavMenuMobile />  
               </div>                       

               <Purchase /> 
               
               <div className="Desktop">
               <FooterDesktop/>
               </div>

               <div className="Mobile">
               <FooterMobile/>
               </div>
    </>
  );
};

export default PurchasePage;
