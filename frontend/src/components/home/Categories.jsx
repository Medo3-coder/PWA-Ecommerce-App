import React, { useEffect, useState } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
// import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import axios from "axios";
import AppURL from "../../utils/AppURL";
import ToastMessages from "../../toast-messages/toast";
import { Link } from "react-router-dom";

function Categories() {
  const [menuData, setMenuData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null); // State for errors

  useEffect(() => {
    const categories = async () => {
      try {
        const response = await axios.get(AppURL.CategoryDetails);
        if (response.status === 200) {
          setMenuData(response.data);
        }
      } catch (e) {
        setError(
          ToastMessages.showError(
            "Failed to load Category Information in page section."
          )
        );
      }finally{
        setLoading(false);
      }
    };

    categories();
  }, []); // Empty dependency array to run this effect only once on mount

 
  if(error){
    return (
      <Container className="text-center">
         <h4>{error}</h4>
      </Container>
    );
  }

  if(loading){
    return (
      <Container className="text-center">
        <h4>Loading Categories ...</h4>
      </Container>
    );
  }

  const MyView = menuData.map((category, index) => (
     <Col key={index} className="p-0" xl={2} lg={2} md={2} sm={6} xs={6}>
      <Link to={`products-by-category/${category.id}`}>
        <Card className="h-100 w-100 text-center">
          <Card.Body>
            <Card.Img
              className="center"
              src={category.category_image}
              alt={category.category_name}
            />
            <h5 className="category-name">{category.category_name}</h5>
          </Card.Body>
        </Card>
      </Link>
    </Col>
  ));

  return (
    <Container className="text-center" fluid={true}>
      <div className="section-title text-center mb-55">
        <h2>Categories </h2>
        {/* <p>Some Of Our Exclusive Collection , You May Like</p> */}
      </div>

      <Row>
      {MyView}
      </Row>
    </Container>
  );
}

export default Categories;
