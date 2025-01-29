import React, { useEffect } from "react";
import FooterDesktop from "../components/common/FooterDesktop";
import FooterMobile from "../components/common/FooterMobile";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import NavMenuMobile from "../components/common/NavMenuMoblie";
import ForgetPassword from "../components/common/ForgetPassword";

const ForgetPasswordPage = () => {

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
    
          <ForgetPassword />
    
          <div className="Desktop">
            <FooterDesktop />
          </div>
    
          <div className="Mobile">
            <FooterMobile />
          </div>
        </>
      );

}

export default ForgetPasswordPage;