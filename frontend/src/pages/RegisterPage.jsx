import React, { useEffect } from "react";
import FooterDesktop from "../components/common/FooterDesktop";
import FooterMobile from "../components/common/FooterMobile";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import NavMenuMobile from "../components/common/NavMenuMoblie";
import Register from "../components/common/Register";


const RegisterPage = () => {

    useEffect(() => {
        window.scroll(0, 0);
      }, []); // Empty dependency array to run only once
    
      return (
        <>
          <div className="Desktop">
            <NavMenuDesktop />
          </div>
    
          <div className="Mobile">
            <NavMenuMobile />
          </div>
    
          <Register />
    
          <div className="Desktop">
            <FooterDesktop />
          </div>
    
          <div className="Mobile">
            <FooterMobile />
          </div>
        </>
      );
  
}

export default RegisterPage
