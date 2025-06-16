import React, {/* useEffect, useState */} from "react";
import { useQuery } from 'react-query';
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
// import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import axios from "axios";
import AppURL from "../../utils/AppURL";
import ToastMessages from "../../toast-messages/toast";
import { Link } from "react-router-dom";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";

function Categories() {

  const { data, error, isLoading } = useQuery('categories', async () => {
    const response = await axios.get(AppURL.CategoryDetails);
    // console.log(response.data.data.categories);
    return response.data.data.categories;
  });

  
  const renderSkeletons = Array.from({ length: 12 }).map((_, index) => (
    <Col key={index} className="p-0" xl={2} lg={2} md={2} sm={6} xs={6}>
      <Card className="h-100 w-100 text-center">
        <Card.Body>
          <Skeleton height={120} />
          <Skeleton width={`60%`} style={{ marginTop: 10 }} />
        </Card.Body>
      </Card>
    </Col>
  ));

  if (isLoading) {
    return (
      <Container className="text-center" fluid={true}>
        <div className="section-title text-center mb-55">
          <h2>Categories</h2>
        </div>
        <Row>{renderSkeletons}</Row>
      </Container>
    );
  }

  if (error) {
    return (
      <Container className="text-center">
        <h4>{ToastMessages.showError(error)}</h4>
      </Container>
    );
  }

  const MyView = data.map((category, index) => (
    <Col key={index} className="p-0" xl={2} lg={2} md={2} sm={6} xs={6}>
      <Link className="text-link" to={`/${category.slug}`}>
        <Card className="h-100 w-100 text-center">
          <Card.Body>
            <Card.Img
              className="center"
              src={category.image}
              alt={category.name}
            />
            <h5 className="category-name">{category.name}</h5>
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
      <Row>{MyView}</Row>
    </Container>
  );
}

export default Categories;
