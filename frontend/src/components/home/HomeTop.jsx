import React, { useEffect, useState } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import MegaMenu from "./MegaMenu";
import HomeSlider from "./HomeSlider";
import axios from "axios";
import AppURL from "../../utils/AppURL";
import ToastMessages from "../../toast-messages/toast";

function HomeTop() {
  const [menuData, setMenuData] = useState([]);
  const [isloading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    // Fetch category data when the component mounts
    const fetchCategories = async () => {
      try {
        const response = await axios.get(AppURL.CateogryDetails);
        setMenuData(response.data);
      } catch (error) {
        setError(ToastMessages.showError("Failed to load categories"));
      } finally {
        setIsLoading(false);
      }
      //Finally Block for Loading State: The finally block ensures that isLoading is set to false regardless of the request's success or failure.
    };

    fetchCategories();
  }, []); // Empty dependency array to run this effect only once on mount
  return (
    <Container className="p-0 m-0 overflow-hidden" fluid={true}>
      <Row>
        {/* mega menu */}
        <Col lg={3} md={3} sm={12}>
          {error ? (
            <p>{error}</p>
          ) : isloading ? (
            <p>Loading categories...</p>
          ) : (
            <MegaMenu data={menuData} />
          )}
        </Col>

        {/* slider menu */}
        <Col lg={9} md={9} sm={12}>
          <HomeSlider />
        </Col>
      </Row>
    </Container>
  );
}

export default HomeTop;
