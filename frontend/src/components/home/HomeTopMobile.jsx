import React, { useEffect, useState } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import HomeSlider from "./HomeSlider";
import axios from "axios";
import AppURL from "../../utils/AppURL";
import ToastMessages from "../../toast-messages/toast";

const HomeTopMobile = () => {
  const [sliderData, setSliderData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchSliderData = async () => {
      try {
        const response = await axios.get(AppURL.Sliders);
        setSliderData(response.data.sliders); // Update state with fetched data
      } catch (error) {
        setError(
          ToastMessages.showError(
            "Failed to load information. Please try again later."
          )
        );
      } finally {
        setLoading(false); // Ensure loading stops in both success and error cases
      }
    };

    fetchSliderData()
  }, []);


  if (error) {
    return <p>Error: {error}</p>;
  }

  if (loading) {
    return <p>Loading...</p>;
  }

  return (
    <>
      <Container className="p-0 m-0 overflow-hidden" fluid={true}>
        <Row className="p-0 m-0 overflow-hidden">
          <Col lg={12} md={12} sm={12}>
          <HomeSlider data={sliderData} />
          </Col>
        </Row>
      </Container>
    </>
  );
};

export default HomeTopMobile;
