import LeftPanel from "@/components/left-panel/LeftPanel";
import RightPanel from "@/components/right-panel/RightPanel";


export const metadata = {
  title: "Home 1 || Ecomus - Ultimate Nextjs Ecommerce Template",
  description: "Ecomus - Ultimate Nextjs Ecommerce Template",
};
export default function Home() {
  return (
    <>
      <LeftPanel />
      <RightPanel />
    </>
  );
}
