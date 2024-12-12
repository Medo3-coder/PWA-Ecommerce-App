import React, { useEffect, useState } from "react";
import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
// import Slider1 from "../../assets/images/slider1.jpg";
// import Slider2 from "../../assets/images/slider2.jpg";
// import Slider3 from "../../assets/images/slider3.jpg";
import axios from "axios";
import AppURL from "../../utils/AppURL";
import ToastMessages from "../../toast-messages/toast";
import Container from "react-bootstrap/esm/Container";

const HomeSlider = () => {
  var settings = {
    dots: true,
    infinite: true,
    speed: 500,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 1,
    slidesToScroll: 1,
    initialSlide: 0,
    arrows: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          initialSlide: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  };

  const [sliderData, setSliderData] = useState([]);
  const [error, setError] = useState(null);
  const [loading, setLoading] = useState(true);

  // UseEffect to fetch products on mount
  useEffect(() => {
    const fetchSlider = async () => {
      try {
        const response = await axios.get(AppURL.Sliders);
        if (response.status === 200) {
          setSliderData(response.data.sliders);
        }
      } catch (error) {
        setError(
          ToastMessages.showError(
            "Failed to load Slider information. Please try again later."
          )
        );
      } finally {
        setLoading(false); // Ensure loading stops in both success and error cases
      }
    };

    fetchSlider();
  }, []); // Empty dependency array to run this effect only once on mount

  if (error) {
    return (
      <Container className="text-center">
        <h4>{error}</h4>
      </Container>
    );
  }

  if (loading) {
    return (
      <Container className="text-center">
        <h4>Loading sliders ...</h4>
      </Container>
    );
  }

  const MyView = sliderData.map((slider, index) => (
    <div key={index}>
      <img
        className="slider-img"
        src={slider.image}
        alt={`slider-${index + 1}`}
      />
    </div>
  ));

  return (
    <div className="slider-container">
      <Slider {...settings}>{MyView}</Slider>
    </div>
  );
};

export default HomeSlider;
