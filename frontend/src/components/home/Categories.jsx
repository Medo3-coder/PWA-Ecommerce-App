import React, { useEffect, useState } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
// import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import axios from "axios";
import AppURL from "../../utils/AppURL";
import ToastMessages from "../../toast-messages/toast";

function Categories() {
  const [category, setCategory] = useState([]); // State for category data
  const [error, setError] = useState(null); // State for errors


 
  useEffect(() => {
    const categories = async () => {
      try {
        const response = await axios.get(AppURL.CateogryDetails);
        if (response.status === 200) {
           // to do we need  to use localStorage here as in Privacy component 
          setCategory(response.data);
          
        }
      } catch (e) {
        setError(
          ToastMessages.showError(
            "Failed to load Category Information in page section."
          )
        );
      }
    };

    categories();
  }, []); // Empty dependency array to run this effect only once on mount

  // If there was an error, display error message
  if (error) {
    return <p>{error}</p>;
  }

  return (
    <Container className="text-center" fluid={true}>
      <div className="section-title text-center mb-55">
        <h2>Categories </h2>
        {/* <p>Some Of Our Exclusive Collection , You May Like</p> */}
      </div>

      <Row>
        {category.length > 0 ? (
          category.map((item, index) => (
            <Col key={index} xl={2} lg={2} md={2} sm={12} xs={12}>
              <Card className="h-100 w-100 text-center">
                <Card.Body>
                  <Card.Img
                    className="center"
                    src={item.category_image}
                    alt={item.category_name}
                  />
                  <h5 className="category-name">{item.category_name}</h5>
                </Card.Body>
              </Card>
            </Col>
          ))
        ) : error ? (
          <p className="text-danger">{error}</p>
        ) : (
          <div>No categories available.</div>
        )}
      </Row>
    </Container>
  );
}

export default Categories;
