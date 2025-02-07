import React, { useContext, useEffect } from "react";
import FooterDesktop from "../components/common/FooterDesktop";
import FooterMobile from "../components/common/FooterMobile";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import NavMenuMobile from "../components/common/NavMenuMoblie";
import Profile from "../components/common/Profile";
import { AuthContext } from "../utils/AuthContext";
import { Container } from "react-bootstrap";

const ProfilePage = () => {
  const { user, loading, logout } = useContext(AuthContext);

  useEffect(() => {
    window.scroll(0, 0);
  }, []); // Empty dependency array to run only once

  if (loading) {
    return (
      <Container className="text-center">
        <h2>Loading...</h2>
      </Container>
    );
  }

  if (!user) {
    return (
      <Container className="text-center">
        <div className="text-center mb-55">
          <h2>Please log in to view your profile.</h2>
        </div>
      </Container>
    );
  }

  return (
    <>
      <div className="Desktop">
        <NavMenuDesktop />
      </div>

      <div className="Mobile">
        <NavMenuMobile />
      </div>

      <Profile userData={user} logout={logout} />

      <div className="Desktop">
        <FooterDesktop />
      </div>

      <div className="Mobile">
        <FooterMobile />
      </div>
    </>
  );
};

export default ProfilePage;
