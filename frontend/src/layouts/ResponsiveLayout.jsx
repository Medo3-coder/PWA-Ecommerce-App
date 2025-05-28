import React from "react";
import FooterDesktop from "../components/common/FooterDesktop";
import FooterMobile from "../components/common/FooterMobile";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import NavMenuMobile from "../components/common/NavMenuMoblie";

export const DesktopLayout = ({ children }) => (
  <div className="Desktop">
    <NavMenuDesktop />
    {children}
    <FooterDesktop />
  </div>
);

export const MobileLayout = ({ children }) => (
  <div className="Mobile">
    <NavMenuMobile />
    {children}
    <FooterMobile />
  </div>
);

export const ResponsiveLayout = ({ children }) => (
  <>
    <DesktopLayout>{children}</DesktopLayout>
    <MobileLayout>{children}</MobileLayout>
  </>
); 