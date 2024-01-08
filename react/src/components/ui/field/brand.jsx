import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { useSpring, animated } from "react-spring";
import { fetchBrandsByFieldId } from "../../../services/brandService";

export default function Brand() {
    const { fieldId } = useParams();
    const [listBrandById, setListBrandById] = useState([]);
    const [scrollPosition, setScrollPosition] = useState(0);

    useEffect(() => {
        getFetchBrandsByFieldId(fieldId);
    }, [fieldId]);

    const getFetchBrandsByFieldId = async () => {
        try {
            let res = await fetchBrandsByFieldId(fieldId);
            if (res && res.data) {
                setListBrandById(res.data);
            }
        } catch (error) {
            console.error("Error fetching fields:", error);
        }
    };

    const scrollProps = useSpring({
        transform: `translateX(${scrollPosition}px)`,
    });

    const scrollLeft = () => {
        setScrollPosition((prev) => prev - 420);
    };

    const scrollRight = () => {
        setScrollPosition((prev) => prev + 420);
    };

    return (
        <div className="relative px-0 2xl:px-[10%] xl:px-[10%] lg:px-[10%] md:px-[5%] sm:px-4 overflow-hidden mt-4">
            <div
                id="brandContainer"
                className="flex px-8 sm:px-4 md:px-8 xl:px-0 items-center overflow-x-hidden relative"
            >
                <animated.div style={scrollProps}>
                    {listBrandById &&
                        listBrandById.length > 0 &&
                        listBrandById.map((brands, index) => (
                            <div
                                className="flex-shrink-0 flex justify-center items-center cursor-pointer w-[20%] sm:w-[20%] md:w-[14%] lg:w-[12%] xl:w-[10%] relative z-10 sm:h-28 lg:h-32 h-20 border px-2"
                                key={index}
                            >
                                <img
                                    className=" w-[60%]"
                                    src={`/src/assets/icon_brand/${brands.logo}`}
                                    alt="img"
                                />
                            </div>
                        ))}
                </animated.div>
            </div>
            <div className="flex justify-between h-full absolute top-0 left-0 right-0 z-20  px-0 2xl:px-[10%] xl:px-[10%] lg:px-[10%] md:px-[5%] sm:px-0  xl:hidden">
                <button
                    onClick={scrollLeft}
                    className=" w-8 bg-gray-200/70 hover:bg-gray-500/60"
                >
                    &lt;
                </button>
                <button
                    onClick={scrollRight}
                    className=" w-8  bg-gray-200/70 hover:bg-gray-500/60"
                >
                    &gt;
                </button>
            </div>
        </div>
    );
}
