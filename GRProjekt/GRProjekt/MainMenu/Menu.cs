using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using Microsoft.Xna.Framework.Graphics;
using Microsoft.Xna.Framework;
using Microsoft.Xna.Framework.Content;
using Microsoft.Xna.Framework.Input;

namespace GRProjekt.MainMenu
{
    public enum MenuList
    {
        newGame,
        authors,
        instruction,
        mainMenu
    }

    public class Menu
    {
        #region Members

        private Texture2D authorsTexture;
        private Texture2D backgroundTexture;
        private Texture2D menuBorderTexture;
        private Texture2D titleTexture;
        private Rectangle destinationRectangle;
        private List<ManuItem> menuItems;
        private ManuItem backButton;
        private Model shipModel;
        private float aspectRatio;
        private float modelRotation = 1.0f;
        private MenuList currentItem;


        #endregion

        #region Constructor

        public Menu(Rectangle destinationRectangle, float aspectRatio)
        {
            this.destinationRectangle = destinationRectangle;
            this.aspectRatio = aspectRatio;
            menuItems = new List<ManuItem>();

            for (int i = 0; i < 4; i++)
            {
                menuItems.Add(new ManuItem(new Vector2(530, 130 + i * 60)));
            }
            backButton = new ManuItem(new Vector2(50,400));
            this.currentItem = MenuList.mainMenu;
        }

        #endregion

        #region Methods

        public void LoadContent(ContentManager content)
        {
            this.backgroundTexture = content.Load<Texture2D>("Graphics/MainMenu/menuBackground");
            this.menuBorderTexture = content.Load<Texture2D>("Graphics/MainMenu/menuBorder");
            this.titleTexture = content.Load<Texture2D>("Graphics/MainMenu/title");
            this.authorsTexture = content.Load<Texture2D>("Graphics/MainMenu/authorBackground");

            menuItems[0].LoadContent(content, "Graphics/MainMenu/newgameButton");
            menuItems[1].LoadContent(content, "Graphics/MainMenu/instructionButton");
            menuItems[2].LoadContent(content, "Graphics/MainMenu/authorsButton");
            menuItems[3].LoadContent(content, "Graphics/MainMenu/exitButton");
            backButton.LoadContent(content, "Graphics/MainMenu/backButton");

            shipModel = content.Load<Model>("Models/Ship/A-Wing");
        }

        public bool Update()
        {
            MouseState mouseState= Mouse.GetState();


            if (mouseState.LeftButton == ButtonState.Pressed && currentItem == MenuList.mainMenu)
            {
                for (int i = 0; i < 4; i++)
                {
                    if (menuItems[i].GetRectangle.Contains(mouseState.X, mouseState.Y) == true)
                    {
                        switch (i)
                        {
                            case 2: currentItem = MenuList.authors; break;
                            case 3: return true;
                        }
                    }
                }
            }
            if (mouseState.LeftButton == ButtonState.Pressed && currentItem == MenuList.authors)
            {
                if (backButton.GetRectangle.Contains(mouseState.X, mouseState.Y) == true)
                {
                     currentItem = MenuList.mainMenu;
                }
            }

            foreach (var item in menuItems)
            {
                Rectangle buff = item.GetRectangle;
                if (buff.Contains(mouseState.X, mouseState.Y) == true && item.mouseOver == false)
                {
                    item.Transform(0);
                }
                buff.Y -= 5;
                if (!buff.Contains(mouseState.X, mouseState.Y) == true && item.mouseOver == true)
                {
                    item.Transform(1);
                }
            }

            Rectangle buff2 = backButton.GetRectangle;
            if (buff2.Contains(mouseState.X, mouseState.Y) == true && backButton.mouseOver == false)
            {
                backButton.Transform(3);
            }
            buff2.X -= 5;
            if (!buff2.Contains(mouseState.X, mouseState.Y) == true && backButton.mouseOver == true)
            {
                backButton.Transform(4);
            }

            modelRotation += 0.02f;
            return false;
        }

        public void Draw(GameTime gameTime, SpriteBatch spriteBatch)
        {
            spriteBatch.Begin();

            spriteBatch.Draw(backgroundTexture, this.destinationRectangle, Color.White);
            spriteBatch.Draw(titleTexture, new Vector2(20, 20), Color.White);

            if (currentItem == MenuList.mainMenu)
            {
                spriteBatch.Draw(menuBorderTexture, new Vector2(500, 100), Color.White);

                foreach (var item in menuItems)
                {
                    item.Draw(gameTime, spriteBatch);
                }

                spriteBatch.End();


                Matrix[] transforms = new Matrix[shipModel.Bones.Count];
                shipModel.CopyAbsoluteBoneTransformsTo(transforms);

                foreach (ModelMesh mesh in shipModel.Meshes)
                {
                    foreach (BasicEffect effect in mesh.Effects)
                    {
                        effect.World = transforms[mesh.ParentBone.Index] * Matrix.CreateRotationY(modelRotation) * Matrix.CreateTranslation(new Vector3(-200, -100, 0));
                        effect.EnableDefaultLighting();

                        effect.View = Matrix.CreateLookAt(new Vector3(0.0f, 50.0f, 400.0f), new Vector3(0, 0, 0), Vector3.Up);

                        effect.Projection = Matrix.CreatePerspectiveFieldOfView(MathHelper.ToRadians(90.0f),
                            aspectRatio, 1.0f, 10000.0f);
                    }
                    mesh.Draw();
                }
            }
            else if (currentItem == MenuList.authors)
            {
                spriteBatch.Draw(authorsTexture, new Vector2(200, 110), Color.White);
                backButton.Draw(gameTime, spriteBatch);
                spriteBatch.End();
            }

        }

        #endregion
    }
}
