import FooterDesktop from "../components/common/FooterDesktop";
import FooterMobile from "../components/common/FooterMobile";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import NavMenuMobile from "../components/common/NavMenuMoblie";
import axios from "axios";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom"; // Import useParams from react-router-dom
import AppURL from "../utils/AppURL";
import SearchList from "../components/ProductDetails/SearchList";
import { Container } from "react-bootstrap";

const SearchPage = () => {
  const { searchKey } = useParams(); // Use searchKey to match the URL parameter
  const [productData, setProductData] = useState([]);

  useEffect(() => {
    window.scrollTo(0, 0); // Scroll to the top when the component mounts

    const fetchProductData = async () => {
      try {
        const response = await axios.get(AppURL.ProductBySearch(searchKey));
        setProductData(response.data);
      } catch (error) {
        // setError(ToastMessages.showError(error.response?.data?.message));
      }
    };

    fetchProductData();
  }, [searchKey]); // Depend on searchKey so it refetches when searchKey changes


  
  if (error) {
    return (
      <Container className="text-center">
        <h4>{error.response?.data?.message}</h4>
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

      <SearchList SearchKey={searchKey} ProductData={productData} />

      <div className="Desktop">
        <FooterDesktop />
      </div>

      <div className="Mobile">
        <FooterMobile />
      </div>
    </>
  );
};

export default SearchPage;