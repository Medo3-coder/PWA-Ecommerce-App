import React, { lazy, Suspense, useEffect } from "react";
import axios from "axios";
import AppURL from "../utils/AppURL";
import Sections from "../components/home/Sections";

// Layout Components
const NavMenuDesktop = lazy(() => import("../components/common/NavMenuDesktop"));
const NavMenuMobile = lazy(() => import("../components/common/NavMenuMoblie"));
const FooterDesktop = lazy(() => import("../components/common/FooterDesktop"));
const FooterMobile = lazy(() => import("../components/common/FooterMobile"));

// Home Components
const HomeTop = lazy(() => import("../components/home/HomeTop"));
const HomeTopMobile = lazy(() => import("../components/home/HomeTopMobile"));
const FeaturedProducts = lazy(() => import("../components/home/FeaturedProducts"));
const NewArrival = lazy(() => import("../components/home/NewArrival"));
const Categories = lazy(() => import("../components/home/Categories"));
const Collection = lazy(() => import("../components/home/Collection"));

// Loading component for Suspense fallback
const LoadingFallback = () => (
  <div className="text-center p-5">
    <div className="spinner-border text-primary" role="status">
      <span className="visually-hidden">Loading...</span>
    </div>
  </div>
);

const HomePage = () => {
  useEffect(() => {
    // Scroll to top on mount
    window.scroll({
      top: 0,
      behavior: "smooth",
    });

    // Track visitor analytics
    const trackVisitor = async () => {
      try {
        const response = await axios.get(AppURL.BaseURL + "/track-visitor");
        console.log(response.data.message);
      } catch (error) {
        console.error("Error tracking visitor:", error.message);
      }
    };

    trackVisitor();
  }, []); // Empty dependency array to run only once

  // Render desktop layout
  const renderDesktopLayout = () => (
    <div className="Desktop">
      <Suspense fallback={<LoadingFallback />}>
        <NavMenuDesktop />
        <HomeTop />
      </Suspense>
    </div>
  );

  // Render mobile layout
  const renderMobileLayout = () => (
    <div className="Mobile">
      <Suspense fallback={<LoadingFallback />}>
        <NavMenuMobile />
        <HomeTopMobile />
      </Suspense>
    </div>
  );

  // Render main content
  const renderMainContent = () => (
    <Suspense fallback={<LoadingFallback />}>
      {/* i need to remove all commented components after make sure sctions is working  */}
      {/* <FeaturedProducts />
      <NewArrival /> */}
      <Categories />
      <Sections />
      {/* <Collection /> */}  
    </Suspense>
  );

  // Render footer
  const renderFooter = () => {
    <>
      <div className="Desktop">
        <Suspense fallback={<LoadingFallback />}>
          <FooterDesktop />
        </Suspense>
      </div>
      <div className="Mobile">
        <Suspense fallback={<LoadingFallback />}>
          <FooterMobile />
        </Suspense>
      </div>
    </>;
  };

  return (
    <>
      <div>
        {renderDesktopLayout()}
        {renderMobileLayout()}
        {renderMainContent()}
        {renderFooter()}
      </div>
    </>
  );
};

export default HomePage;

//React.Suspense is a React component that allows you to "wait" for some other component to load
//To show a fallback UI (like a spinner or message) while the component is loading in the background.