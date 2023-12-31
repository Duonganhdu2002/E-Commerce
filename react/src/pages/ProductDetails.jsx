import React from "react";
import Header from "../components/ui/Header";
import Navbar from "../components/ui/Navbar";
import MenuBar from "../components/ui/MenuBar";
import SubFooter from "../components/ui/Subfooter";
import Footer from "../components/ui/Footer";
import LayoutProductDetails from "../components/ui/LayoutProductDetails";

export default function ProductDetails() {
    return (
        <div>
            <Header />
            <Navbar />
            <MenuBar />
            <LayoutProductDetails />
            <SubFooter/>
            <Footer/>
        </div>
    );
}
