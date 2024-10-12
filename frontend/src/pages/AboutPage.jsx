import React, { useEffect } from "react";
import FooterDesktop from "../components/common/FooterDesktop";
import FooterMobile from "../components/common/FooterMobile";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import NavMenuMobile from "../components/common/NavMenuMoblie";
import About from "../components/others/About";

const AboutPage = () => {
  
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

      <About />

      <div className="Desktop">
        <FooterDesktop />
      </div>

      <div className="Mobile">
        <FooterMobile />
      </div>
    </>
  );
};

export default AboutPage;
