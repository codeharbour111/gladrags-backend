import React from "react";
import Image from "next/image";
import Link from "next/link";

export default function RightPanel() {
  return (
    <div className="section-content-right">
      <div className="header-dashboard">
        <div className="wrap">
          <div className="header-left">
            <Link href="/" legacyBehavior>
              <a>
                <Image
                  id="logo_header_mobile"
                  alt="Logo"
                  src="/images/logo/logo.svg"
                  data-light="/images/logo/logo.svg"
                  data-dark="/images/logo/logo-white.svg"
                  width={100}
                  height={50}
                />
              </a>
            </Link>
            <div className="button-show-hide">
              <i className="icon-chevron-left"></i>
            </div>
            <form className="form-search flex-grow">
              <fieldset className="name">
                <input
                  type="text"
                  placeholder="Search"
                  className="show-search"
                  name="name"
                  tabIndex="2"
                  required
                />
              </fieldset>
              <div className="button-submit">
                <button className="" type="submit">
                  <i className="icon-search"></i>
                </button>
              </div>
              <div className="box-content-search" id="box-content-search">
                <ul className="mb-24">
                  <li className="mb-14">
                    <div className="body-title">Top selling product</div>
                  </li>
                  <li className="mb-14">
                    <div className="divider"></div>
                  </li>
                  <li>
                    <ul>
                      <li className="product-item gap14 mb-10">
                        <div className="image no-bg">
                          <Image
                            src="/images/products/product-1.jpg"
                            alt="Product 1"
                            width={50}
                            height={50}
                          />
                        </div>
                        <div className="flex items-center justify-between gap20 flex-grow">
                          <div className="name">
                            <Link href="/product-list" legacyBehavior>
                              <a className="body-text">Neptune Longsleeve</a>
                            </Link>
                          </div>
                        </div>
                      </li>
                      <li className="mb-10">
                        <div className="divider"></div>
                      </li>
                      <li className="product-item gap14 mb-10">
                        <div className="image no-bg">
                          <Image
                            src="/images/products/product-2.jpg"
                            alt="Product 2"
                            width={50}
                            height={50}
                          />
                        </div>
                        <div className="flex items-center justify-between gap20 flex-grow">
                          <div className="name">
                            <Link href="/product-list" legacyBehavior>
                              <a className="body-text">Ribbed Tank Top</a>
                            </Link>
                          </div>
                        </div>
                      </li>
                      <li className="mb-10">
                        <div className="divider"></div>
                      </li>
                      <li className="product-item gap14">
                        <div className="image no-bg">
                          <Image
                            src="/images/products/product-3.jpg"
                            alt="Product 3"
                            width={50}
                            height={50}
                          />
                        </div>
                        <div className="flex items-center justify-between gap20 flex-grow">
                          <div className="name">
                            <Link href="/product-list" legacyBehavior>
                              <a className="body-text">Ribbed modal T-shirt</a>
                            </Link>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
                <ul className="">
                  <li className="mb-14">
                    <div className="body-title">Order product</div>
                  </li>
                  <li className="mb-14">
                    <div className="divider"></div>
                  </li>
                  <li>
                    <ul>
                      <li className="product-item gap14 mb-10">
                        <div className="image no-bg">
                          <Image
                            src="/images/products/product-4.jpg"
                            alt="Product 4"
                            width={50}
                            height={50}
                          />
                        </div>
                        <div className="flex items-center justify-between gap20 flex-grow">
                          <div className="name">
                            <Link href="/product-list" legacyBehavior>
                              <a className="body-text">
                                Oversized Motif T-shirt
                              </a>
                            </Link>
                          </div>
                        </div>
                      </li>
                      <li className="mb-10">
                        <div className="divider"></div>
                      </li>
                      <li className="product-item gap14 mb-10">
                        <div className="image no-bg">
                          <Image
                            src="/images/products/product-5.jpg"
                            alt="Product 5"
                            width={50}
                            height={50}
                          />
                        </div>
                        <div className="flex items-center justify-between gap20 flex-grow">
                          <div className="name">
                            <Link href="/product-list" legacyBehavior>
                              <a className="body-text">
                                V-neck linen T-shirt
                              </a>
                            </Link>
                          </div>
                        </div>
                      </li>
                      <li className="mb-10">
                        <div className="divider"></div>
                      </li>
                      <li className="product-item gap14 mb-10">
                        <div className="image no-bg">
                          <Image
                            src="/images/products/product-6.jpg"
                            alt="Product 6"
                            width={50}
                            height={50}
                          />
                        </div>
                        <div className="flex items-center justify-between gap20 flex-grow">
                          <div className="name">
                            <Link href="/product-list" legacyBehavior>
                              <a className="body-text">Jersey thong body</a>
                            </Link>
                          </div>
                        </div>
                      </li>
                      <li className="mb-10">
                        <div className="divider"></div>
                      </li>
                      <li className="product-item gap14">
                        <div className="image no-bg">
                          <Image
                            src="/images/products/product-7.jpg"
                            alt="Product 7"
                            width={50}
                            height={50}
                          />
                        </div>
                        <div className="flex items-center justify-between gap20 flex-grow">
                          <div className="name">
                            <Link href="/product-list" legacyBehavior>
                              <a className="body-text">Jersey thong body</a>
                            </Link>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </form>
          </div>
          <div className="header-grid">
            <div className="header-item country">
              <select className="image-select no-text">
                <option data-thumbnail="/images/country/1.png">ENG</option>
                <option data-thumbnail="/images/country/9.png">VIE</option>
              </select>
            </div>
            <div className="header-item button-dark-light">
              <i className="icon-moon"></i>
            </div>
            <div className="popup-wrap noti type-header">
              <div className="dropdown">
                <button
                  className="btn btn-secondary dropdown-toggle"
                  type="button"
                  id="dropdownMenuButton1"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <span className="header-item">
                    <span className="text-tiny">1</span>
                    <i className="icon-bell"></i>
                  </span>
                </button>
                <ul
                  className="dropdown-menu dropdown-menu-end has-content"
                  aria-labelledby="dropdownMenuButton1"
                >
                  <li>
                    <h6>Notifications</h6>
                  </li>
                  <li>
                    <div className="noti-item w-full wg-user active">
                      <div className="image">
                        <Image
                          src="/images/customers/customer-1.jpg"
                          alt="Customer 1"
                          width={50}
                          height={50}
                        />
                      </div>
                      <div className="flex-grow">
                        <div className="flex items-center justify-between">
                          <Link href="#" legacyBehavior>
                            <a className="body-title">Cameron Williamson</a>
                          </Link>
                          <div className="time">10:13 PM</div>
                        </div>
                        <div className="text-tiny">Hello?</div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div className="noti-item w-full wg-user active">
                      <div className="image">
                        <Image
                          src="/images/customers/customer-2.jpg"
                          alt="Customer 2"
                          width={50}
                          height={50}
                        />
                      </div>
                      <div className="flex-grow">
                        <div className="flex items-center justify-between">
                          <Link href="#" legacyBehavior>
                            <a className="body-title">Ralph Edwards</a>
                          </Link>
                          <div className="time">10:13 PM</div>
                        </div>
                        <div className="text-tiny">
                          Are you there? interested in this...
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div className="noti-item w-full wg-user active">
                      <div className="image">
                        <Image
                          src="/images/customers/customer-3.jpg"
                          alt="Customer 3"
                          width={50}
                          height={50}
                        />
                      </div>
                      <div className="flex-grow">
                        <div className="flex items-center justify-between">
                          <Link href="#" legacyBehavior>
                            <a className="body-title">Eleanor Pena</a>
                          </Link>
                          <div className="time">10:13 PM</div>
                        </div>
                        <div className="text-tiny">Interested in this loads?</div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div className="noti-item w-full wg-user active">
                      <div className="image">
                        <Image
                          src="/images/customers/customer-1.jpg"
                          alt="Customer 1"
                          width={50}
                          height={50}
                        />
                      </div>
                      <div className="flex-grow">
                        <div className="flex items-center justify-between">
                          <Link href="#" legacyBehavior>
                            <a className="body-title">Jane Cooper</a>
                          </Link>
                          <div className="time">10:13 PM</div>
                        </div>
                        <div className="text-tiny">Okay...Do we have a deal?</div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <Link href="#" legacyBehavior>
                      <a className="tf-button w-full">View all</a>
                    </Link>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
